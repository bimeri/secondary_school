<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Thirdtermresult extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'student_id', 'seq5', 'seq6',
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }

    public static function getStudentClassRecord($year, $class){
        $query = Thirdtermresult::select('student_id as stud_id',
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
