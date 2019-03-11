<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 6:33 PM
 */

namespace App\Repositories\Student;


interface IStudentRepository
{
    public function getAllStudents();
    public function getStudentById($id);
    public function getByIdAndPersonalProfile($id);
    public function getByIdAndProgramInfo($id);
    public function getByProgramId($programId);
    public function saveStudent(array $attributes);
    public function updateStudent($id, array $attributes);
    public function updateStudentBy(array $where, array $attributes);
    public function deleteStudent($id);
}