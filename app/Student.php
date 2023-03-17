<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender',
        'permanent_address',
        'provincial_address',
        'home_number',
        'mobile_number',
        'course',
        'school',
        'year',
        'skype_id',
        'program_id_no',
        'sevis_id',
        'host_company_id',
        'position',
        'location',
        'housing_details',
        'stipend',
        'fb_email',
        'visa_interview_status',
        'visa_interview_schedule',
        'visa_interview_time',
        'program_start_date',
        'program_end_date',
        'visa_sponsor_id',
        'date_of_departure',
        'date_of_arrival',
        'application_id',
        'program_id',
        'application_status',
        'coordinator_id',
        'branch',
        'contacted_status'
    ];

    public static function getAllStudents()
    {
        return self::with(['user', 'company', 'tertiary.school', 'program', 'log'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public static function getStudentByProgramId($id)
    {
        return self::getAllStudents()->where('program_id', $id);
    }

    public function log()
    {
        return $this->hasMany('App\Log', 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasOne('App\HostCompany', 'id', 'host_company_id')
                    ->withDefault([
                        'name'  =>  '',
                        'states'=>  ''
                    ]);
    }

    public function school()
    {
        return $this->hasOne('App\School', 'id', 'school');
    }

    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function coordinator()
    {
        return $this->hasOne('App\Coordinator', 'user_id', 'coordinator_id');
    }

    public function father()
    {
        return $this->hasOne('App\Father', 'user_id', 'user_id')
                    ->withDefault([
                        'user_id'       =>  '',
                        'first_name'    =>  '',
                        'middle_name'   =>  '',
                        'last_name'     =>  '',
                        'occupation'    =>  '',
                        'contact_no'    =>  ''
                    ]);
    }

    public function mother()
    {
        return $this->hasOne('App\Mother', 'user_id', 'user_id')
                    ->withDefault([
                        'user_id'       =>  '',
                        'first_name'    =>  '',
                        'middle_name'   =>  '',
                        'last_name'     =>  '',
                        'occupation'    =>  '',
                        'contact_no'    =>  ''
                    ]);
    }

    public function primary()
    {
        return $this->hasOne('App\Primary', 'user_id', 'user_id')
                    ->withDefault([
                        'school_name'   =>  '',
                        'address'       =>  '',
                        'date_graduated'=>  ''
                    ]);
    }

    public function secondary()
    {
        return $this->hasOne('App\Secondary', 'user_id', 'user_id')
                    ->withDefault([
                        'school_name'   =>  '',
                        'address'       =>  '',
                        'date_graduated'=>  ''
                    ]);
    }

    public function experience()
    {
        return $this->hasMany('App\Experience', 'user_id', 'user_id');
    }

    public function sponsor()
    {
        return $this->hasOne('App\Sponsor', 'id', 'visa_sponsor_id')
                    ->withDefault([
                        'id'            =>  '',
                        'name'          =>  '',
                        'display_name'  =>  '',
                        'description'   =>  ''
                    ]);
    }

    //public function payment()
    //{
    //    return $this->hasMany('App\ProgramPayment', 'program_id', 'program_id');
    //}

    public function studentPayment()
    {
        return $this->hasMany(StudentPayment::class, 'user_id', 'user_id');
    }

    public function getByProgramId($id)
    {
        $user = User:: whereRoleIs('student')
                    ->with('student')
                    ->get();

        return $user;
    }

    public function getByUserId($userId)
    {
        $user = $this->where('user_id', $userId)->first();

        return $user;
    }

    public function payment()
    {
        return $this->hasMany('App\PaymentRequirement', 'program_id', 'program_id');
    }
}
