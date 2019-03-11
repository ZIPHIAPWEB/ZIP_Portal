<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:50 PM
 */

namespace App\Repositories\PreliminaryRequirement;


use App\PreliminaryRequirement;
use App\Repositories\Base\BaseRepository;

class PreliminaryRequirementRepository extends BaseRepository implements IPreliminaryRequirementRepository
{
    public function __construct(PreliminaryRequirement $model)
    {
        parent::__construct($model);
    }

    public function getAllPreliminaryRequirement()
    {
        return $this->findAll();
    }

    public function getByProgram($id)
    {
        return $this->findBy(['program_id' => $id]);
    }

    public function getById($id)
    {
        return $this->findBy(['id' => $id]);
    }

    public function getByProgramIdAndUserId($programId, $userId)
    {
        $data = $this->findByWhereWith(['program_id' => $programId], ['studentPreliminary' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);

        return $this->paginate($data);
    }

    public function savePreliminaryRequirement(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updatePreliminaryRequirement($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deletePreliminaryRequirement($id)
    {
        return $this->delete($id);
    }
}