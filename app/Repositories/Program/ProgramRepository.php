<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/28/2019
 * Time: 3:58 PM
 */

namespace App\Repositories\Program;


use App\Program;
use App\Repositories\Base\BaseRepository;

class ProgramRepository extends BaseRepository implements IProgramRepository
{
    public function __construct(Program $model)
    {
        parent::__construct($model);
    }

    public function getAllProgram()
    {
        return $this->findAll(['*'], 'name', 'asc');
    }

    public function getProgramById($id)
    {
        return $this->findBy(['id' => $id]);
    }

    public function saveProgram(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updateProgram($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deleteProgram($id)
    {
        return $this->delete($id);
    }
}