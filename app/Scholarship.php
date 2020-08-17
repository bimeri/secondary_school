<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Scholarship extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'form_id', 'student_id', 'amount', 'reason'
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function term(){
        return $this->belongsTo('App\Term');
    }
    public static function getYearlyScholarship($year_id, $student_id){
        $total = Scholarship::where('year_id', $year_id)->where('student_id', $student_id)->sum('amount');
        return $total;
    }
}
