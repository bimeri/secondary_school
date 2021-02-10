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

    public static function getStudentYearlyScholarship($year_id, $student_id, $termId, $formId){
        $total = Scholarship::where('year_id', $year_id)
                            ->where('student_id', $student_id)
                            ->where('term_id', $termId)
                            ->where('form_id', $formId)
                            ->sum('amount');
        return $total;
    }

    public static function getAllScholarship($year){
        return Scholarship::where('year_id', $year)->get();
    }

    public static function getSumAmount($year){
        return Scholarship::where('year_id', $year)->sum('amount');
    }

    public static function getStudentAcademicScholarship($student, $year, $term, $form){
        $query = Scholarship::where('student_id', $student)
                            ->where('year_id', $year)
                            ->where('term_id', $term)
                            ->where('form_id', $form)
                            ->first();
        return $query;
    }
}
