<?php

namespace App;

use App\Mail\verifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable, HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vToken', 'verified', 'isOnline', 'isFilled', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function experiences() 
    {
        return $this->hasMany(Experience::class, 'user_id', 'id');
    }

    public function student()
    {
        return $this->hasOne(Student::class,'user_id', 'id');
    }

    public function studentPayment()
    {
        return $this->hasMany(StudentPayment::class, 'user_id', 'id');
    }

    public function studentPreliminary()
    {
        return $this->hasMany(StudentPreliminary::class, 'user_id', 'id');
    }

    public function studentAdditional()
    {
        return $this->hasMany(StudentAdditional::class, 'user_id', 'id');
    }

    public function studentVisaSponsor()
    {
        return $this->hasMany(StudentSponsor::class, 'user_id', 'id');
    }

    public function tertiary()
    {
        return $this->hasOne(Tertiary::class, 'user_id', 'id');
    }

    public function secondary()
    {
        return $this->hasOne(Secondary::class, 'user_id', 'id');
    }

    public function father()
    {
        return $this->hasOne(Father::class, 'user_id', 'id');
    }

    public function mother()
    {
        return $this->hasOne(Mother::class, 'user_id', 'id');
    }

    public function coordinator()
    {
        return $this->hasOne('App\Coordinator', 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function sendEmailVerification()
    {
        Mail::to($this->email)->send(new verifyEmail($this));
    }

    public function checkIfUserVerified()
    {
        return $this->verified == 1 ? true : false;
    }
}
