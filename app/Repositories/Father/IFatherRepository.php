<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:44 PM
 */

namespace App\Repositories\Father;


interface IFatherRepository
{
    public function saveFather(array $attributes);
    public function updateFather($id, array $attributes);
    public function deleteFather($id);
}