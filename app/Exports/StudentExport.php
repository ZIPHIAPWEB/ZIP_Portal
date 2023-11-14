<?php

namespace App\Exports;

use App\Http\Resources\ExportStudentResource;
use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    private $start;
    private $end;
    private $programId;
    private $status;

    public function __construct($start, $end, $status, $programId)
    {
        $this->start = $start;
        $this->end = $end;
        $this->status = $status;
        $this->programId = $programId;
    }

    public function headings(): array
    {
        return [
            'APPLICANT ID',
            'DATE OF PAYMENT',
            'FIRST NAME',
            'MIDDLE NAME',
            'LAST NAME',
            'SCHOOL NAME',
            'COURSE',
            'TARGET DATE OF GRADUATION',
            'CONTACT NUMBER',
            'PERMANENT ADDRESS',
            'EMAIL ADDRESS',
            'SKYPE ADDRESS',
            'FACEBOOK',
            'DATE OF BIRTH',
            'STATUS',
            'POSITION HIRED FOR',
            'STATE',
            'PROGRAM START DATE',
            'PROGRAM END DATE',
            'VISA SPONSOR'
        ];
    }

    public function collection()
    {
        if ($this->status == 'All') {
            $this->status = '';
        }

        if ($this->programId) {
            $students = Student::query()
                ->orWhereBetween('created_at', [$this->start, $this->end])
                ->orWhere('application_status', 'like', '%' . $this->status . '%')
                ->where('program_id', 'like', '%' . $this->programId . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $students = Student::query()
                ->orWhereBetween('created_at', [$this->start, $this->end])
                ->orWhere('application_status', 'like', '%' . $this->status . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return ExportStudentResource::collection($students);
    }
}