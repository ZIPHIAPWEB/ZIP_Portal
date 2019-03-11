<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:40 PM
 */

namespace App\Repositories\Coordinator;


use App\Coordinator;
use App\Repositories\Base\BaseRepository;

class CoordinatorRepository extends BaseRepository implements ICoordinatorRepository
{
    public function __construct(Coordinator $model)
    {
        parent::__construct($model);
    }

    public function getCoordinatorByUserId($userId)
    {
        return parent::findOneBy(['user_id' => $userId]);
    }

    public function saveCoordinator(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateCoordinator($id, array $attributes)
    {
        return parent::whereUpdate(['user_id' => $id], $attributes);
    }

    public function deleteCoordinator($id)
    {
        return parent::delete($id);
    }
}