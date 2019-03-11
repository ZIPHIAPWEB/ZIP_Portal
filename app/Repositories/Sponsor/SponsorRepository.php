<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/1/2019
 * Time: 1:46 PM
 */

namespace App\Repositories\Sponsor;


use App\Repositories\Base\BaseRepository;
use App\Sponsor;

class SponsorRepository extends BaseRepository implements ISponsorRepository
{
    public function __construct(Sponsor $model)
    {
        parent::__construct($model);
    }

    public function getAllSponsor()
    {
        return parent::findAll();
    }

    public function getSponsorById($id)
    {
        return parent::findBy(['id' => $id]);
    }

    public function saveSponsor(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateSponsor($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteSponsor($id)
    {
        return parent::delete($id);
    }
}