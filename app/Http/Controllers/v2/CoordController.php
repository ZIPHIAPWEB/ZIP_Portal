<?php

namespace App\Http\Controllers\v2;

use App\Actions\ConvertProgramToIdAction;
use App\Actions\ProgressToNextStatus;
use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoordStudentResource;
use App\Http\Resources\StudentContactResource;
use App\Http\Resources\StudentExperienceResource;
use App\Http\Resources\StudentFlightDetailsResource;
use App\Http\Resources\StudentParentResource;
use App\Http\Resources\StudentPdosCfoScheduleResource;
use App\Http\Resources\StudentPersonalResource;
use App\Http\Resources\StudentSecondaryResource;
use App\Http\Resources\StudentVIsaInterviewResource;
use App\Http\Resources\StudentVisaSponsorResource;
use App\Http\Resources\TertiaryResource;
use App\Http\Resources\UserResource;
use App\Program;
use App\Student;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class CoordController extends Controller
{
    public function exportStudentDatas(Request $request)
    {
        $filename = 'student-data-'. Carbon::now()->timestamp;
        Excel::store(
            new StudentExport(
                $request->input('from'),
                $request->input('to'),
                $request->input('status'),
                (new ConvertProgramToIdAction())->execute($request->input('program'))
            ),
            $filename .'.xlsx',
            'local'
        );

        return response()->json($filename . '.xlsx', 200);
    }

    public function getStatusStatistics(Request $request)
    {
        $query = Student::query();

        $query->when($request->input('program') !== null, function ($q) use ($request) {

            return $q->where('program_id', $request->input('program'));
        });

        $students = $query->get();

        return response()->json([
            'message' => 'Student statistics loaded!',
            'status' => Response::HTTP_OK,
            'data' => [
                'all' => count($students),
                'new_applicant' => $students->where('application_status', 'New Applicant')->count(),
                'assessed' => $students->where('application_status', 'Assessed')->count(),
                'confirmed' => $students->where('application_status', 'Confirmed')->count(),
                'hired' => $students->where('application_status', 'Hired')->count(),
                'for_visa_interview' => $students->where('application_status', 'For Visa Interview')->count(),
                'for_pdos_cfo' => $students->where('application_status', 'For PDOS & CFO')->count(),
                'program_proper' => $students->where('application_status', 'Program Proper')->count(),
                'returned' => $students->where('application_status', 'Returned')->count()
            ]
        ], Response::HTTP_OK);
    }

    public function getStudents(Request $request)
    {
        $query = Student::query();

        $query->when($request->input('program') !== null, function ($q) use ($request) {

            return $q->where('program_id', (new ConvertProgramToIdAction())->execute($request->input('program')));
        });

        $query->when($request->input('from_date') !== null, function ($q) use ($request) {

            return $q->whereBetween('created_at', [$request->input('from_date'), $request->input('to_date') ?? Carbon::now()->toDateString()]);
        });

        $query->when($request->input('status') !== null, function ($q) use ($request) {

            return $q->where('application_status', $request->input('status'));
        });

        $students = $query->paginate(1);

        return CoordStudentResource::collection($students);
    }

    public function showStudent(User $student)
    {
        return response()->json([
            'data' => [
                'user' => new UserResource($student),
                'personal' => new StudentPersonalResource($student),
                'contact' => new StudentContactResource($student->student),
                'tertiary' => new TertiaryResource($student),
                'secondary' => new StudentSecondaryResource($student->secondary),
                'father' => new StudentParentResource($student->father),
                'mother' => new StudentParentResource($student->mother),
                'experiences' => StudentExperienceResource::collection($student->experiences()->orderBy('created_at', 'DESC')->get())
            ]
        ]);
    }

    public function updateStudentProgram($userId, Request $request)
    {
        $request->validate([
            'programId' => 'required'
        ]);

        Student::query()
            ->where('user_id', $userId)
            ->update([
                'program_id' => $request->input('programId')
            ]);

        return response()->json([
            'data' => [
                'message' => 'Student program successfully updated!',
                'program' => Student::query()->where('user_id', $userId)->first()->program->display_name,
                'status' => 200
            ]
        ]);
    }

    public function cancelStudentProgram($userId, Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        $reason = 'Cancel: ' . $request->input('reason');

        $student = Student::query()
            ->where('user_id', $userId);

        if (!$student->exists()) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'User not exists'
            ], Response::HTTP_NOT_FOUND);
        }

        $student->update([
            'application_status' => $reason
        ]);

        return response()->json([
            'status' => Response::HTTP_OK,
            'application_status' => $reason
        ], Response::HTTP_OK);
    }

    public function updateProgramStatus($userId, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $processedStatus = (new ProgressToNextStatus())->execute($request->input('status'));

        if(!isset($processedStatus)) {

            return response()->json([
                'data' => [
                    'message' => 'Unable to process this request',
                    'status' => 422
                ]
            ]);
        }

        $student = Student::query()->where('user_id', $userId);

        if ($processedStatus['status'] == 'Confirmed') {
            $programId = Program::find($student->first()->program_id)->description . '-'. (date('Y') + 1) . rand(0, 9999);
            $student->update([
                'application_id' => $programId,
                'application_status' => $processedStatus['status']
            ]);
        } else {
            $student->update([
                'application_status' => $processedStatus['status']
            ]);
        }

        return response()->json([
            'data' => [
                'message' => 'Student program successfully updated!',
                'application_status' => $processedStatus['status'],
                'status' => 200
            ]
        ]);
    }

    public function getStudentHostInfo($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        return response()->json([
            'data' => [
                'status' => 200,
                'visa_sponsor' => new StudentVisaSponsorResource($student)
            ]
        ]);
    }

    public function updateStudentHostInfo($userId, Request $request)
    {
        $student = Student::query()->where('user_id', $userId);

        $student->update([
            'visa_sponsor_id' => $request->input('visa_sponsor_id'),
            'host_company_id' => $request->input('host_company_id'),
            'housing_details' => $request->input('housing_address'),
            'position' => $request->input('position'),
            'stipend' => $request->input('stipend'),
            'program_start_date' => $request->input('start_date'),
            'program_end_date' => $request->input('end_date')
        ]);

        return new StudentVisaSponsorResource($student->first());
    }

    public function getStudentInterviewInfo($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        return new StudentVIsaInterviewResource($student);
    }

    public function updateStudentInterviewInfo($userId, Request $request)
    {
        $student = Student::query()->where('user_id', $userId);

        $student->update([
            'visa_interview_status' => $request->input('visa_interview_status'),
            'program_id_no' => $request->input('program_id_number'),
            'sevis_id' => $request->input('sevis_id'),
            'visa_interview_schedule' => $request->input('visa_interview_schedule'),
            'visa_interview_time' => $request->input('visa_interview_time'),
            'trial_interview_schedule' => $request->input('trial_interview_schedule'),
            'trial_interview_time' => $request->input('trial_interview_time')
        ]);

        return new StudentVIsaInterviewResource($student->first());
    }

    public function getStudentPdosCfoInfo($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        return new StudentPdosCfoScheduleResource($student);
    }

    public function updateStudentPdosCfoInfo($userId, Request $request)
    {
        $student = Student::query()->where('user_id', $userId);

        $student->update([
            'pdos_schedule' => $request->input('pdos_schedule'),
            'pdos_schedule_time' => $request->input('pdos_schedule_time'),
            'cfo_schedule' => $request->input('cfo_schedule'),
            'cfo_schedule_time' => $request->input('cfo_schedule_time')
        ]);

        return new StudentPdosCfoScheduleResource($student->first());
    }

    public function getStudentFlightInfo($userId)
    {
        $student = Student::query()->where('user_id', $userId)->first();

        return new StudentFlightDetailsResource($student);
    }

    public function updateStudentFlightInfo($userId, Request $request)
    {
        $request->validate([
            'data' => 'required'
        ]);

        try {
            $student = Student::query()->where('user_id', $userId);

            $student->update($request->input('data'));

            return new StudentFlightDetailsResource($student->first());
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 422,
                'message' => 'Unable to process data'
            ], 422);
        }
    }
}
