<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Year extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'name', 'active'
    ];

    public function terms(){
        return $this->hasMany('App\Term');
    }

    public function settings(){
        return $this->hasMany('App\Setting');
    }

    public function feetypes(){
        return $this->hasMany('App\Feetype');
    }
    public function expensetypes(){
        return $this->hasMany('App\Expensetype');
    }
    public function scholarships(){
        return $this->hasMany('App\Scholarship');
    }
    public function fees(){
        return $this->hasMany('App\Fee');
    }
    public function studentinfos(){
        return $this->hasMany('App\Studentinfo');
    }
    public function feeecontrols(){
        return $this->hasMany('App\Feecontrol');
    }
}
