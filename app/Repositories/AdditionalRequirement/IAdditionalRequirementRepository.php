<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:49 PM
 */

namespace App\Repositories\AdditionalRequirement;

interface IAdditionalRequirementRepository
{
    public function getAllAdditionalRequirements();
    public function getByProgram($programId);
    public function getById($id);
    public function getByProgramIdAndUserId($programId, $userId);
    public function saveAdditionalRequirement(array $attributes);
    public function updateAdditionalRequirement($id, array $attributes);
    public function deleteAdditionalRequirement($id);
}
