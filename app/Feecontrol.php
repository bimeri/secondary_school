<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feecontrol extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'student_id', 'student_school_id', 'form_id', 'year_id', 'clearance_date'
    ];
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }

    public static function completedStudent($year, $class){
        $query = Feecontrol::where('year_id', $year)->where('form_id', $class)->get();
        return $query;
    }

    public static function notcompletedStudent($year, $class){
        $allStudentPerclass = Promotion::getStudentPerClassAndYear($year, $class);
        $completedArray = [];
        $allStudentArray = [];
        $noPaidArray = [];
        $completedStudent = Self::completedStudent($year, $class);
        foreach($completedStudent as $complete){
            array_push($completedArray, $complete->student_id);
        }
        foreach($allStudentPerclass as $all){
            array_push($allStudentArray, $all->student_id);
            if(in_array($all->student_id, $completedArray)){}
            else {
            array_push($noPaidArray, $all);
            }
        }
        return $noPaidArray;
    }
}
