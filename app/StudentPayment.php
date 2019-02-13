<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        'user_id',
        'requirement_id',
        'status',
        'path'
    ];

    public function payment()
    {
        return $this->hasOne('App\PaymentRequirement' ,'requirement_id', 'id');
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
