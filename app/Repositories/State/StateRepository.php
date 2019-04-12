<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/8/2019
 * Time: 3:52 PM
 */

namespace App\Repositories\State;


use App\Repositories\Base\BaseRepository;
use App\State;

class StateRepository extends BaseRepository implements IStateRepository
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    public function getAllState()
    {
        return parent::findAll();
    }

    public function saveState(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateState(int $id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteState(int $id)
    {
        return parent::delete($id);
    }
}