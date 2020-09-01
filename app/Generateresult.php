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

    public static function getStudentsResult($year, $term, $class){
        $query = Generateresult::where('year_id', $year)
                ->where('form_id' , $class)
                ->where('term_id', $term)
                ->where('rank_student', 1)
                ->get();
        return $query;
    }
}
