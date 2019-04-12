<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 2:10 PM
 */

namespace App\Repositories\StudAdditional;


interface IStudAdditionalRepository
{
    public function getById($id);
    public function saveStudAdditional(array $attributes);
    public function updateStudAdditional($id, array $attributes);
    public function deleteStudAdditional($id);
}