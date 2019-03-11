<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:46 PM
 */

namespace App\Repositories\Primary;


interface IPrimaryRepository
{
    public function savePrimary(array $attributes);
    public function updatePrimary($id, array $attributes);
    public function deletePrimary($id);
}