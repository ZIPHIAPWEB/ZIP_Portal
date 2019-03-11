<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequirement extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'description',
        'path'
    ];

    public function studentPayment()
    {
        return $this->belongsTo('App\StudentPayment', 'id', 'requirement_id')
                    ->withDefault([
                        'status'    =>  false
                    ]);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getByProgram($programId)
    {
        return $this->where('program_id', $programId)->orderBy('created_at', 'desc')->get();
    }
}
