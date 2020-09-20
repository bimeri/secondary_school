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

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public static function getYearlyScholarship($year_id, $student_id){
        $total = Scholarship::where('year_id', $year_id)->where('student_id', $student_id)->sum('amount');
        return $total;
    }

    public static function getAllScholarship($year){
        return Scholarship::where('year_id', $year)->get();
    }

    public static function getSumAmount($year){
        return Scholarship::where('year_id', $year)->sum('amount');
    }
}
