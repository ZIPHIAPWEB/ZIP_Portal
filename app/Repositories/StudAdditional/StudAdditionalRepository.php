<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 2:09 PM
 */

namespace App\Repositories\StudAdditional;


use App\Repositories\Base\BaseRepository;
use App\StudentPreliminary;

class StudAdditionalRepository extends BaseRepository implements IStudAdditionalRepository
{
    public function __construct(StudentPreliminary $model)
    {
        parent::__construct($model);
    }

    public function saveStudAdditional(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateStudAdditional($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteStudAdditional($id)
    {
        return parent::delete($id);
    }
}