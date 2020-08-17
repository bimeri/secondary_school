<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Background extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'name', 'sector_id'
    ];

    public function sector(){
        return $this->belongsTo('App\Sector');
    }

    public function forms(){
        return $this->hasMany('App\Form');
    }
    // public function feetypes(){
    //     return $this->hasMany('App\Feetype');
    // }
}
