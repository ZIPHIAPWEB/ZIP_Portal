<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/22/2019
 * Time: 10:33 AM
 */

namespace App\Repositories\Degree;


use App\Degree;
use App\Repositories\Base\BaseRepository;

class DegreeRepository extends BaseRepository implements IDegreeRepository
{
    public function __construct(Degree $model)
    {
        parent::__construct($model);
    }

    public function getAllDegree()
    {
        return parent::findAll();
    }

    public function getOneDegree(int $id)
    {
        return parent::findOneBy(['id' => $id]);
    }

    public function saveDegree(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateDegree(int $id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteDegree(int $id)
    {
        return parent::delete($id);
    }
}