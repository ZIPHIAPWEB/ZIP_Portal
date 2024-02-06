<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function student()
    {
        return $this->belongsTo('App\Student', 'program_id', 'id');
    }

    public function programRequirement()
    {
        return $this->hasMany('App\ProgramRequirement', 'program_id', 'id');
    }

    public function programCategory()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id', 'id');
    }
}
