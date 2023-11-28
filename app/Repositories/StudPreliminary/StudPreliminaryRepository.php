<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 2:08 PM
 */

namespace App\Repositories\StudPreliminary;

use App\Repositories\Base\BaseRepository;
use App\StudentPreliminary;

class StudPreliminaryRepository extends BaseRepository implements IStudPreliminaryRepository
{
    public function __construct(StudentPreliminary $model)
    {
        parent::__construct($model);
    }

    public function saveStudPreliminary(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateStudPreliminary($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteStudPreliminary($id)
    {
        return parent::delete($id);
    }

    public function getById($id)
    {
        return parent::findOneBy(['id' => $id]);
    }
}
