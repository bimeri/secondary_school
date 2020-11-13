<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    //
    use Notifiable;
    protected $guard = 'teacher';
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'user_name', 'profile', 'date_of_birth', 'gender', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects(){
        return $this->hasMany('App\Subject');
    }

    public function files(){
        return $this->hasMany('App\file');
    }

    public function assignments(){
        return $this->hasMany('App\Assignment');
    }
    // public function teachersubjects(){
    //     return $this->belongsToMany('App\Teachersubject');
    // }
}
