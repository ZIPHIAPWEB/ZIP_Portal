<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:50 PM
 */

namespace App\Repositories\PreliminaryRequirement;


interface IPreliminaryRequirementRepository
{
    public function getAllPreliminaryRequirement();
    public function getByProgramIdAndUserId($programId, $userId);
    public function savePreliminaryRequirement(array $attributes);
    public function updatePreliminaryRequirement($id, array $attributes);
    public function deletePreliminaryRequirement($id);
}