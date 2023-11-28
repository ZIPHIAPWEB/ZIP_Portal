<?php

namespace App\Http\Controllers;

use App\Repositories\Student\StudentRepository;

class AccountingController extends Controller
{
    private $studentRepository;
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function accountingProgram($id)
    {
        return view('pages.program.program-accounting')->with('program', $id);
    }

    public function viewAllStudents($id)
    {
        return $this->studentRepository->getAllStudentsWithPayment($id);
    }
}
