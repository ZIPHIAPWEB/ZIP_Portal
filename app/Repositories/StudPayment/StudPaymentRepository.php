<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 3/4/2019
 * Time: 1:40 PM
 */

namespace App\Repositories\StudPayment;


use App\Repositories\Base\BaseRepository;
use App\StudentPayment;

class StudPaymentRepository extends BaseRepository implements IStudPaymentRepository
{
    public function __construct(StudentPayment $model)
    {
        parent::__construct($model);
    }

    public function getById($id)
    {
        return parent::findOneBy(['id' => $id]);
    }

    public function saveStudPayment(array $attributes)
    {
        return parent::save($attributes);
    }

    public function updateStudPayment($id, array $attributes)
    {
        return parent::update($id, $attributes);
    }

    public function deleteStudPayment($id)
    {
        return parent::delete($id);
    }
}