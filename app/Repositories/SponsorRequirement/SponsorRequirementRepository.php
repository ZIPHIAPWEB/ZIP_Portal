<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/28/2019
 * Time: 11:00 AM
 */

namespace App\Repositories\SponsorRequirement;

use App\Repositories\Base\BaseRepository;
use App\SponsorRequirement;

class SponsorRequirementRepository extends BaseRepository implements ISponsorRequirementRepository
{
    public function __construct(SponsorRequirement $model)
    {
        parent::__construct($model);
    }

    public function getAllSponsorRequirement()
    {
        return parent::findAll();
    }

    public function getBySponsor($sponsorId)
    {
        return parent::findBy(['sponsor_id' => $sponsorId]);
    }

    public function getById($id)
    {
        return parent::findOneBy(['id' => $id]);
    }

    public function getBySponsorIdAndUserId($sponsorId, $userId)
    {
        return parent::findByWhereWith(['sponsor_id' => $sponsorId], ['studentVisa' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);
    }

    public function saveSponsorRequirement(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateSponsorRequirement($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteSponsorRequirement($id)
    {
        return parent::delete($id);
    }
}
