<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 8:03 PM
 */

namespace App\Repositories\Experience;

interface IExperienceRepository
{
    public function saveExperience(array $attributes);
    public function updateExperience($id, array $attributes);
    public function deleteExperience($id);
}
