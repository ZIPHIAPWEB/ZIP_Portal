<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 11:34 AM
 */

namespace App\Repositories\HostCompany;

interface IHostCompanyRepository
{
    public function getAllHostCompany();
    public function getHostCompanyById($id);
    public function saveHostCompany(array $attributes);
    public function updateHostCompany($id, array $attributes);
    public function deleteHostCompany($id);
}
