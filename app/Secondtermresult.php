<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Secondtermresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'student_id', 'seq3', 'seq4',
    ];

    public function students(){
        return $this->hasMany('App\Student');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }

    public static function getStudentClassRecord($year, $class){
        $query = Secondtermresult::select('student_id as stud_id',
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
}
