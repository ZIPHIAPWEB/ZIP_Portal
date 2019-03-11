<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:52 PM
 */

namespace App\Repositories\School;


use App\Repositories\Base\BaseRepository;
use App\School;

class SchoolRepository extends BaseRepository implements ISchoolRepository
{
    public function __construct(School $model)
    {
        parent::__construct($model);
    }

    public function getAllSchool()
    {
        return parent::findAll();
    }

    public function saveSchool(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateSchool($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteSchool($id)
    {
        return parent::delete($id);
    }

    public function getSchoolById($id)
    {
        return parent::findBy(['id' => $id]);
    }
}