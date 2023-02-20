<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        'user_id',
        'requirement_id',
        'bank_code',
        'reference_no',
        'date_deposit',
        'bank_account_no',
        'amount',
        'status',
        'acknowledgement',
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
