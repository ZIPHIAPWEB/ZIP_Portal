<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:52 PM
 */

namespace App\Repositories\School;

interface ISchoolRepository
{
    public function getAllSchool();
    public function getSchoolById($id);
    public function saveSchool(array $attributes);
    public function updateSchool($id, array $attributes);
    public function deleteSchool($id);
}
