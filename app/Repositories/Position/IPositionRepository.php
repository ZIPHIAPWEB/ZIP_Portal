<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/8/2019
 * Time: 4:34 PM
 */

namespace App\Repositories\Position;

interface IPositionRepository
{
    public function getAll();
    public function savePosition(array $attributes);
    public function updatePosition(int $id, array $attributes);
    public function deletePosition(int $id);
}
