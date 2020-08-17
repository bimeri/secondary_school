<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expensetype extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'expense_type', 'reason',
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function term(){
        return $this->belongsTo('App\Term');
    }
}
