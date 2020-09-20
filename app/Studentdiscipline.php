<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Studentdiscipline extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'term_id', 'student_id', 'discipline_id', 'consequences'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function discipline(){
        return $this->belongsTo('App\Discipline');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function term(){
        return $this->belongsTo('App\Term');
    }

    public static function getalldiscipline(){
        $query = Studentdiscipline::all();
        return $query;
    }
}
