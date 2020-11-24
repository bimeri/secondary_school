<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Generateresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'form_id', 'number_of_student','number_passed', 'class_avg', 'highest_avg', 'lowest_avg', 'rank_student'
    ];

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public function term(){
        return $this->belongsTo('App\Term');
    }

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public static function getStudentsResult($year, $term, $class){
        $query = Generateresult::where('year_id', $year)
                ->where('form_id' , $class)
                ->where('term_id', $term)
                ->where('rank_student', 1)
                ->get();
        return $query;
    }

    public static function getClassYearlyResult($year){
        return Generateresult::where('year_id', $year)->get();
    }

    public static function getClassTermResult($year, $term, $class){
        return Generateresult::where('year_id', $year)
                                ->where('term_id', $term)
                                ->where('form_id', $class)
                                ->first();
    }
}
