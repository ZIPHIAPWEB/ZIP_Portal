<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/14/2019
 * Time: 2:09 PM
 */

namespace App\Repositories\StudSponsor;

interface IStudSponsorRepository
{
    public function saveStudSponsor(array $attributes);
    public function updateStudSponsor(array $attributes, int $id);
    public function deleteStudSponsor(int $id);
}
