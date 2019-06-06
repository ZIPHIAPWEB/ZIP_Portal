<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 11:34 AM
 */

namespace App\Repositories\HostCompany;


use App\HostCompany;
use App\Repositories\Base\BaseRepository;

class HostCompanyRepository extends BaseRepository implements IHostCompanyRepository
{
    public function __construct(HostCompany $model)
    {
        parent::__construct($model);
    }

    public function getAllHostCompany()
    {
        return parent::findAll(['*'], 'name', 'asc');
    }

    public function getHostCompanyById($id)
    {
        return parent::findBy(['id' => $id]);
    }

    public function saveHostCompany(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateHostCompany($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteHostCompany($id)
    {
        return parent::delete($id);
    }
}