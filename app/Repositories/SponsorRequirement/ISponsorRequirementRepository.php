<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/28/2019
 * Time: 11:00 AM
 */

namespace App\Repositories\SponsorRequirement;


interface ISponsorRequirementRepository
{
    public function getAllSponsorRequirement();
    public function getBySponsorIdAndUserId($sponsorId, $userId);
    public function saveSponsorRequirement(array $attributes);
    public function updateSponsorRequirement($id, array $attributes);
    public function deleteSponsorRequirement($id);
}