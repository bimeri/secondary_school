<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Promotion extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'form_id', 'student_id', 'form_type', 'remark'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }
}
