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
        return Studentinfo::where('student_id', $student_id)->orderBy('id', 'desc')->first();
    }

    public static function getStudentMatricule($student_id){
        $mat = Studentinfo::select('student_school_id')->where('student_id', $student_id)->first();
        return $mat->student_school_id;
    }
     public static function getStudentByName($student_id){
        $qu = Studentinfo::select('*')->where('student_id', $student_id)->first();
        return $qu->student->full_name;
    }

    public static function getStudentByMatricule($matricule){
        $qu = Studentinfo::where('student_school_id', $matricule)->first();
        return $qu;
    }

    public static function getAllStudentPerYear($year){
        return Studentinfo::where('year_id', $year)->orderBy('id', 'desc')->get();
    }

    public static function getAllStudentPerYearAndClass($year, $class){
        return Studentinfo::where('year_id', $year)->where('form_id', $class)->orderBy('id', 'desc')->get();
    }

    public static function getAllStudentPerYearClassAndSubClass($year, $class, $subformId){
        return Studentinfo::where('year_id', $year)
                            ->where('form_id', $class)
                            ->where('subform_id', $subformId)
                            ->orderBy('id', 'desc')->get();
    }
    public static function getTenStudents(){
       return Studentinfo::latest()->take(10)->get();
    }

    public static function countAllSchoolStudentPerYear($year_id){
       return Studentinfo::where('year_id', $year_id)->count();
    }

    public static function countAllclassStudent($year, $form, $subclass){
        return Studentinfo::where('year_id', $year)
                            ->where('form_id', $form)
                            ->where('subform_id', $subclass)
                            ->count();
    }
}
