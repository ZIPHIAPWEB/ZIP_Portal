<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreliminaryRequirement extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'description',
        'path'
    ];

    public function studentPreliminary()
    {
        return $this->belongsTo('App\StudentPreliminary', 'id', 'requirement_id')
                    ->withDefault([
                        'program_id' =>  false,
                        'name'       =>  false,
                        'description'=>  false,
                        'path'       =>  false,
                        'status'     =>  false
                    ]);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getByProgram($programId)
    {
        return $this->where('program_id', '=', $programId)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
