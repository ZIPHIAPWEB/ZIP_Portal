<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:40 PM
 */

namespace App\Repositories\Coordinator;


interface ICoordinatorRepository
{
    public function getCoordinatorByUserId($userId);
    public function saveCoordinator(array $attributes);
    public function updateCoordinator($id, array $attributes);
    public function deleteCoordinator($id);
}