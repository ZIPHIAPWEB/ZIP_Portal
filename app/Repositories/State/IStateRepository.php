<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/8/2019
 * Time: 3:52 PM
 */

namespace App\Repositories\State;


interface IStateRepository
{
    public function getAllState();
    public function saveState(array $attributes);
    public function updateState(int $id, array $attributes);
    public function deleteState(int $id);
}