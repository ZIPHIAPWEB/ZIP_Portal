<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:45 PM
 */

namespace App\Repositories\Mother;


interface IMotherRepository
{
    public function saveMother(array $attributes);
    public function updateMother($id, array $attributes);
    public function deleteMother($id);
}