<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/27/2019
 * Time: 7:43 PM
 */

namespace App\Repositories\PaymentRequirement;


interface IPaymentRequirementRepository
{
    public function getById($id);
    public function getByProgram($programId);
    public function getByProgramIdAndUserId($programId, $userId);
    public function savePaymentRequirement(array $attributes);
    public function updatePaymentRequirement($id, array $attributes);
    public function deletePaymentRequirement($id);
}