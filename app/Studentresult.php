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
}
