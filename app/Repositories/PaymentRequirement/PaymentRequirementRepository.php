<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:43 PM
 */

namespace App\Repositories\PaymentRequirement;


use App\PaymentRequirement;
use App\Repositories\Base\BaseRepository;

class PaymentRequirementRepository extends BaseRepository implements IPaymentRequirementRepository
{
    public function __construct(PaymentRequirement $model)
    {
        parent::__construct($model);
    }

    public function getByProgramIdAndUserId($programId, $userId)
    {
        return $this->findByWhereWith(['program_id' => $programId], ['studentPayment' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }]);
    }

    public function savePaymentRequirement(array $attributes)
    {
        return $this->save($attributes);
    }

    public function updatePaymentRequirement($id, array $attributes)
    {
        return $this->update($id, $attributes);
    }

    public function deletePaymentRequirement($id)
    {
        return $this->delete($id);
    }

    public function getById($id)
    {
        return $this->findBy(['id' => $id]);
    }

    public function getByProgram($programId)
    {
        return $this->findBy(['program_id' => $programId]);
    }
}