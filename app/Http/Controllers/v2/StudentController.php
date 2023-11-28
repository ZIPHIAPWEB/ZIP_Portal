<?php

namespace App\Http\Controllers\v2;

use App\Experience;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Http\Resources\StudentContactResource;
use App\Http\Resources\StudentExperienceResource;
use App\Http\Resources\StudentParentResource;
use App\Http\Resources\StudentPersonalResource;
use App\Http\Resources\StudentSecondaryResource;
use App\Http\Resources\TertiaryResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use LogicException;

class StudentController extends Controller
{
    /**
     * @return StudentPersonalResource
     * @throws BindingResolutionException
     */
    public function getPersonalDetails()
    {
        $student = auth()->user();

        return new StudentPersonalResource($student);
    }

    /**
     * @return StudentContactResource
     * @throws BindingResolutionException
     */
    public function getContactDetails()
    {
        $student = auth()->user()->student;

        return new StudentContactResource($student);
    }

    /**
     * @return TertiaryResource
     * @throws BindingResolutionException
     */
    public function getTertiaryDetails()
    {
        $student = auth()->user();

        return new TertiaryResource($student);
    }

    /**
     * @return StudentSecondaryResource
     * @throws BindingResolutionException
     */
    public function getSecondaryDetails()
    {
        $student = auth()->user()->secondary;

        return new StudentSecondaryResource($student);
    }

    /**
     * @return StudentParentResource
     * @throws BindingResolutionException
     */
    public function getFatherDetails()
    {
        $student = auth()->user()->father;

        return new StudentParentResource($student);
    }

    /**
     * @return StudentParentResource
     * @throws BindingResolutionException
     */
    public function getMotherDetails()
    {
        $student = auth()->user()->mother;

        return new StudentParentResource($student);
    }

    /**
     * @return AnonymousResourceCollection
     * @throws BindingResolutionException
     */
    public function getExperiencesDetails()
    {
        $student = auth()->user()->experiences()->orderBy('created_at', 'DESC')->get();

        return StudentExperienceResource::collection($student);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updatePersonalDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'skype_id' => $request->skype_id,
            'fb_email' => $request->fb_email
        ]);

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updateContactDetails(Request $request)
    {
        $student = auth()->user()->student();

        $student->update([
            'provincial_address' => $request->provincial_address,
            'permanent_address' => $request->permanent_address,
            'mobile_number' => $request->mobile_number,
            'home_number' => $request->home_number,
        ]);

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updateTertiaryDetails(Request $request)
    {
        $auth = auth()->user();

        $auth->tertiary()->updateOrCreate(
            [
                'user_id' => $auth->id
            ],
            [
                'school_name' => $request->school,
                'address' => $request->address,
                'degree' => $request->degree,
                'start_date' => $request->start_date,
                'date_graduated' => $request->date_graduated
            ]
        );

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updateSecondaryDetails(Request $request)
    {
        $auth = auth()->user();

        $auth->secondary()->updateOrCreate(
            [
                'user_id' => $auth->id
            ],
            [
                'school_name' => $request->school,
                'address' => $request->address,
                'start_date' => $request->start_date,
                'date_graduated' => $request->date_graduated
            ]
        );

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updateFatherDetails(Request $request)
    {
        $auth = auth()->user();

        $auth->father()->updateOrCreate(
            [
                'user_id' => $auth->id
            ],
            [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'occupation' => $request->occupation,
                'contact_no' => $request->contact_no,
                'company' => $request->company
            ]
        );

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BindingResolutionException
     */
    public function updateMotherDetails(Request $request)
    {
        $auth = auth()->user();

        $auth->mother()->updateOrCreate(
            [
                'user_id' => $auth->id
            ],
            [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'occupation' => $request->occupation,
                'contact_no' => $request->contact_no,
                'company' => $request->company
            ]
        );

        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return ExperienceResource
     * @throws BindingResolutionException
     */
    public function addWorkExperience(Request $request)
    {
        $experience = Experience::create([
            'user_id' => auth()->user()->id,
            'company' => $request->company,
            'address' => $request->address,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return new ExperienceResource($experience);
    }

    /**
     * @param Request $request
     * @param Experience $experience
     * @return ExperienceResource
     * @throws MassAssignmentException
     */
    public function updateWorkExperience(Request $request, Experience $experience)
    {
        $experience->update([
            'company' => $request->company,
            'address' => $request->address,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description
        ]);

        return new ExperienceResource($experience);
    }

    /**
     * @param Experience $experience
     * @return Response
     * @throws LogicException
     * @throws BindingResolutionException
     */
    public function deleteWorkExperience(Experience $experience)
    {
        $experience->delete();

        return response()->noContent();
    }
}
