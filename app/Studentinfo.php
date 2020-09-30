<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Studentinfo extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'student_school_id', 'student_id', 'form_id', 'subform_id', 'parent_contact', 'parent_email', 'address', 'profile', 'date_of_birth', 'gender'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function studentresult(){
        return $this->belongsTo('App\Studentresult');
    }

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function subform(){
        return $this->belongsTo('App\Subclass');
    }

    public static function getStudentInfo($student_id){
        return Studentinfo::where('student_id', $student_id)->first();
    }

    public static function getStudentMatricule($student_id){
        $mat = Studentinfo::select('student_school_id')->where('student_id', $student_id)->first();
        return $mat->student_school_id;
    }

    public static function getAllStudentPerYear($year){
        return Studentinfo::where('year_id', $year)->groupBy('student_school_id')->get();
    }

    public static function getAllStudentPerYearAndClass($year, $class){
        return Studentinfo::where('year_id', $year)->where('form_id', $class)->get();
    }
}
