<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 6:32 PM
 */

namespace App\Repositories\Student;


use App\Repositories\Base\BaseRepository;
use App\Student;
use Illuminate\Http\UploadedFile;

class StudentRepository extends BaseRepository implements IStudentRepository
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function getAllStudents()
    {
        return parent::findWith(['user', 'program', 'tertiary.school']);
    }

    public function getByIdAndPersonalProfile($id)
    {
        return $this->findOneByWhereWith(['user_id' => $id], ['mother', 'father', 'primary', 'secondary', 'tertiary.school', 'experience', 'program']);
    }

    public function getByIdAndProgramInfo($id)
    {
        return $this->findOneByWhereWith(['user_id' => $id], ['coordinator', 'company', 'sponsor', 'program']);
    }

    public function getByIdAndFullDetails($id)
    {
        return $this->findOneByWhereWith(['user_id' => $id], ['user', 'mother', 'father', 'primary', 'secondary', 'tertiary.school', 'experience', 'company', 'sponsor']);
    }

    public function getByProgramId($programId)
    {
        return $this->findByWhereWith(['program_id' => $programId], ['user', 'company', 'tertiary.school', 'program', 'log' => function ($query) {
            $query->orderBy('created_at', 'desc')->first();
        }]);
    }

    public function saveStudent(array $attributes)
    {
        $attributes['first_name'] = strtoupper($attributes['first_name']);
        $attributes['middle_name'] = strtoupper($attributes['middle_name']);
        $attributes['last_name'] = strtoupper($attributes['last_name']);
        return $this->save($attributes);
    }

    public function updateStudent($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function updateStudentBy(array $where, array $attributes)
    {
        return $this->whereUpdate($where, $attributes);
    }

    public function deleteStudent($id)
    {
        return $this->delete($id);
    }

    public function getStudentById($id)
    {
        return parent::findOneBy(['user_id' => $id]);
    }
}