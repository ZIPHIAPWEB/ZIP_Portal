<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:20 PM
 */

namespace App\Repositories\CoordinatorAction;

interface ICoordinatorActionRepository
{
    public function saveCoordinatorAction(array $attributes);
    public function deleteCoordinatorAction($id);
}
