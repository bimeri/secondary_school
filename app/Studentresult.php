<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Studentresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'class_id', 'student_id', 'student_school_id', 'average_point', 'sum_coff', 'stud_ave', 'remark'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function term(){
        return $this->belongsTo('App\Term');
    }

    public function studentinfos(){
        return $this->hasMany('App\Studentinfo');
    }

    public static function getHighestAverage($year, $term, $class){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->max('stud_ave');
        return $qr;
       }

    public static function getLowestAverage($year, $term, $class){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->min('stud_ave');
        return $qr;
       }

    public static function getAverage($year, $term, $class){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->sum('stud_ave');
        return $qr;
       }

    public static function getPassedStudent($year, $term, $class){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->where('stud_ave', '>=', 10)
           ->count();
        return $qr;
       }

    public static function getStudent($year, $term, $class){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->orderBy('stud_ave', 'DESC')
           ->get();
        return $qr;
       }
     public static function getStudentPerClass($year, $term, $class, $type){
        $qr = Studentresult::where('year_id', $year)
           ->where('term_id', $term)
           ->where('form_id', $class)
           ->where('form_type', $type)
           ->orderBy('stud_ave', 'DESC')
           ->get();
           foreach ($qr as $key => $value) {
            Studentresult::where('year_id', $year)
            ->where('term_id', $term)
            ->where('form_id', $class)
            ->where('student_id', $value->student_id)
            ->update(['class_position' => ($key+1)]);
           }

        return "success";
       }
    public static function getStudentClassResult($year, $term, $class, $type){
        return Studentresult::where('year_id', $year)
        ->where('term_id', $term)
        ->where('form_id', $class)
        ->where('form_type', $type)
        ->orderBy('stud_ave', 'DESC')
        ->get();
    }

    public static function getStudentResult($year, $term, $class, $studentid){
        return Studentresult::where('year_id', $year)
        ->where('term_id', $term)
        ->where('form_id', $class)
        ->where('student_id', $studentid)
        ->first();
    }
}
