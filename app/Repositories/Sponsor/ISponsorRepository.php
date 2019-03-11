<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 1:46 PM
 */

namespace App\Repositories\Sponsor;


interface ISponsorRepository
{
    public function getAllSponsor();
    public function getSponsorById($id);
    public function saveSponsor(array $attributes);
    public function updateSponsor($id, array $attributes);
    public function deleteSponsor($id);
}