<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Firsttermresult extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'student_id', 'seq1', 'seq2', 'ave_point'
    ];

    public function subject(){
        return $this->belongsTo('App\subject');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }

    public static function getStudentClassRecord($year, $class){
        $query = Firsttermresult::select('student_id as stud_id',
                                         'seq1', 'seq2', 'ave_point as points',
                                         'students.school_id as stud_card',
                                         'subjects.coefficient as subject_coff')
        ->where('firsttermresults.year_id', $year)
        ->where('firsttermresults.form_id', $class)
        ->join('students', 'firsttermresults.student_id', 'students.id')
        ->join('subjects', 'firsttermresults.subject_id', 'subjects.id')
        ->orderBy('students.id')
        ->get();
        return $query;
    }

    public static function getResultByClass($year, $class){
        $query = Firsttermresult::select('firsttermresults.id', 'firsttermresults.student_id as stud_id',
                                         'firsttermresults.seq1', 'firsttermresults.seq2',
                                          'firsttermresults.ave_point as points',
                                         'students.school_id as school_id',
                                         'subjects.coefficient as subject_coff',
                                         'subjects.name as subject_name',
                                         'studentinfos.subform_id as sub_class',
                                         'subclasses.type as class_type', 'subclasses.form_id as class')
        ->where('firsttermresults.year_id', $year)
        ->where('firsttermresults.form_id', $class)
        ->join('students', 'firsttermresults.student_id', 'students.id')
        ->join('subjects', 'firsttermresults.subject_id', 'subjects.id')
        ->join('studentinfos', 'students.id', 'studentinfos.student_id')
        ->join('subclasses', 'studentinfos.subform_id', 'subclasses.id')
        ->orderBy('students.id')
        ->get();
        return $query;
    }
}
