<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:47 PM
 */

namespace App\Repositories\Secondary;


interface ISecondaryRepository
{
    public function saveSecondary(array $attributes);
    public function updateSecondary($id, array $attributes);
    public function deleteSecondary($id);
}