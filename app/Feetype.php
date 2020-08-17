<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feetype extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'form_id', 'fee_type', 'amount',
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function fees(){
        return $this->hasMany('App\Fee');
    }

    public static function getAllFeesPerClassAndYear($year_id, $form_id){
        $feetype = Feetype::where('year_id', $year_id)->where('form_id', $form_id)->sum('amount');
        return $feetype;
    }

    // public function background(){
    //     return $this->belongsTo('App\Background');
    // }

    // public function sector(){
    //     return $this->belongsTo('App\Sector');
    // }
}
