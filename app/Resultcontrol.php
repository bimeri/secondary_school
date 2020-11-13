<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Resultcontrol extends Model
{
    //
    use Notifiable;

    public $fillable = [
        'year_id', 'term_id', 'seq1_id', 'seq2_id', 'generateresult_id', 'status'
    ];
    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function seq1(){
        return $this->belongsTo('App\Sequence');
    }
    public function seq2(){
        return $this->belongsTo('App\Sequence');
    }

    public function term(){
        return $this->belongsTo('App\Term');
    }
}
