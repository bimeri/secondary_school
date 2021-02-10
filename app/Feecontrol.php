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
        $allStudentPerclass[] = Promotion::getStudentPerClassAndYear($year, $class);
        $completedStudent = Self::completedStudent($year, $class);
        foreach($completedStudent as $complete){

        }
        return $allStudentPerclass;
    }
}
