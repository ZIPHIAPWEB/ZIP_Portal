<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 2:09 PM
 */

namespace App\Repositories\StudPreliminary;


interface IStudPreliminaryRepository
{
    public function getById($id);
    public function saveStudPreliminary(array $attributes);
    public function updateStudPreliminary($id, array $attributes);
    public function deleteStudPreliminary($id);
}