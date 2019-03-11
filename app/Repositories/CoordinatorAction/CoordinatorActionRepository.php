<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:19 PM
 */

namespace App\Repositories\CoordinatorAction;


use App\CoordinatorAction;
use App\Repositories\Base\BaseRepository;

class CoordinatorActionRepository extends BaseRepository implements ICoordinatorActionRepository
{
    public function __construct(CoordinatorAction $model)
    {
        parent::__construct($model);
    }

    public function saveCoordinatorAction(array $attributes)
    {
        return parent::save($attributes);
    }

    public function deleteCoordinatorAction($id)
    {
        return parent::delete($id);
    }
}