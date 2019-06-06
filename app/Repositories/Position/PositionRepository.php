<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/8/2019
 * Time: 4:34 PM
 */

namespace App\Repositories\Position;


use App\Position;
use App\Repositories\Base\BaseRepository;

class PositionRepository extends BaseRepository implements IPositionRepository
{
    public function __construct(Position $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return parent::findAll(['*'], 'name', 'asc');
    }

    public function savePosition(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updatePosition(int $id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deletePosition(int $id)
    {
        return parent::delete($id);
    }
}