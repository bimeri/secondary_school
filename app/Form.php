<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Form extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'code', 'type', 'max_number', 'background_id'
    ];

    public function background(){
        return $this->belongsTo('App\Background');
    }
    public function students(){
        return $this->hasMany('App\Student');
    }
    public function subclasses(){
        return $this->hasMany('App\Subclass');
    }
    public function studentinfos(){
        return $this->hasMany('App\Studentinfo');
    }
    public function subjects(){
        return $this->hasMany('App\Subject');
    }
    public function feetypes(){
        return $this->hasMany('App\Feetype');
    }
    public function fees(){
        return $this->hasMany('App\Fee');
    }
    public function feecontrols(){
        return $this->hasMany('App\Feecontrol');
    }
    public function generateresults(){
        return $this->hasMany('App\Generateresult');
    }

    public function scholarships(){
        return $this->hasMany('App\Scholarship');
    }

    public static function getClassDetail($class){
        return Form::where('id', $class)->first();
    }
}
