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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentRequirement::class, 'requirement_id');
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
