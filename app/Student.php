<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $guard = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'school_id', 'email', 'place_of_birth', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function subclass(){
        return $this->belongsTo('App\Subclass');
    }

    public function studentinfo(){
        return $this->hasOne('App\Studentinfo');
    }
    public function studentdisciplines(){
        return $this->hasMany('App\Studentdiscipline');
    }

    public function feecontrols(){
        return $this->hasMany('App\Feecontrol');
    }
    public function firsttermresults(){
        return $this->hasMany('App\Firsttermresult');
    }
    public function secondtermresults(){
        return $this->hasMany('App\Secondtermresult');
    }

    public function thirdtermresults(){
        return $this->hasMany('App\Thirdtermresult');
    }

    public function scholarships(){
        return $this->hasMany('App\Scholarship');
    }
    public function promotions(){
        return $this->belongsTo('App\Promotion');
    }

    public function fees(){
        return $this->hasMany('App\Fee');
    }

    public function studentresults(){
        return $this->hasMany('App\Studentresult');
    }

    public static function getAllStudent(){
        $query = Student::orderBy('full_name')->get();
        return $query;
    }

    public static function getStudentByMatricule($matricule){
        $query = Student::where('school_id', $matricule)->first();
        return $query;
    }
}
