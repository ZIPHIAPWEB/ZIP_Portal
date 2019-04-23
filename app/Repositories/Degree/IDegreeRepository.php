<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 4/22/2019
 * Time: 10:33 AM
 */

namespace App\Repositories\Degree;


interface IDegreeRepository
{
    public function getAllDegree();
    public function getOneDegree(int $id);
    public function saveDegree(array $attributes);
    public function updateDegree(int $id, array $attributes);
    public function deleteDegree(int $id);
}