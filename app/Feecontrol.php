<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feecontrol extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'student_id', 'student_school_id', 'form_id', 'year_id', 'clearance_date'
    ];
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }
}
