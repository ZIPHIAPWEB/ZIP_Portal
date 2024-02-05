<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:40 PM
 */

namespace App\Repositories\StudPayment;

interface IStudPaymentRepository
{
    public function saveStudPayment(array $attributes);
    public function updateStudPayment($id, array $attributes);
    public function deleteStudPayment($id);
}
