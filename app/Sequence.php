<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sequence extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'name', 'term_id', 'active'
    ];

    public function term(){
        return $this->belongsTo('App\Term');
    }
}
