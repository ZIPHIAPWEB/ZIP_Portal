<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:45 PM
 */

namespace App\Repositories\Mother;


use App\Mother;
use App\Repositories\Base\BaseRepository;

class MotherRepository extends BaseRepository implements IMotherRepository
{
    public function __construct(Mother $model)
    {
        parent::__construct($model);
    }

    public function saveMother(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updateMother($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deleteMother($id)
    {
        return $this->delete($id);
    }
}