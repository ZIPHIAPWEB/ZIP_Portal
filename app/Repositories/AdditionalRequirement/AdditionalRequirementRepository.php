<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:48 PM
 */

namespace App\Repositories\AdditionalRequirement;


use App\AdditionalRequirement;
use App\Repositories\Base\BaseRepository;

class AdditionalRequirementRepository extends BaseRepository implements IAdditionalRequirementRepository
{
    public function __construct(AdditionalRequirement $model)
    {
        parent::__construct($model);
    }

    public function getAllAdditionalRequirements()
    {
        return $this->findAll();
    }

    public function getByProgramIdAndUserId($programId, $userId)
    {
        return $this->findByWhereWith(['program_id' => $programId], ['studentAdditional' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);
    }

    public function saveAdditionalRequirement(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updateAdditionalRequirement($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deleteAdditionalRequirement($id)
    {
        return $this->delete($id);
    }

    public function getByProgram($programId)
    {
        return $this->findBy(['program_id' => $programId]);
    }

    public function getById($id)
    {
        return $this->findBy(['id' => $id]);
    }
}