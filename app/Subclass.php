<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subclass extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'form_id', 'type', 'max_number',
    ];

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public function studentinfo(){
        return $this->belongsTo('App\Studentinfo');
    }

    public function students(){
        return $this->hasMany('App\Student');
    }
}
