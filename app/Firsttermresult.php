<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Firsttermresult extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'form_type', 'student_id', 'seq1', 'seq2', 'ave_point'
    ];

    public function subject(){
        return $this->belongsTo('App\subject');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }

    public static function getStudentClassRecord($year, $class){
        $query = Firsttermresult::
        select('student_id as stud_id',
                'seq1',
                'seq2',
                'form_type',
                'ave_point as points',
                'students.school_id as stud_card',
                'subjects.coefficient as subject_coff')
        ->join('students', 'firsttermresults.student_id', 'students.id')
        ->join('subjects', 'firsttermresults.subject_id', 'subjects.id')
        ->where('firsttermresults.year_id', $year)
        ->where('firsttermresults.form_id', $class)
        ->orderBy('students.id')
        ->get();
        return $query;
    }

    public static function getResultByClass($year, $class){
        $query = Firsttermresult::
                select('firsttermresults.id',
                       'firsttermresults.student_id as studentId',
                       'firsttermresults.seq1',
                       'firsttermresults.seq2',
                       'firsttermresults.ave_point as points',
                       'firsttermresults.form_type',
                       'students.school_id as schoolId',
                       'subjects.coefficient as cofficient',
                       'subjects.name as subjectName',
                       'students.full_name as studentName'
                        )
        ->join('students', 'firsttermresults.student_id', 'students.id')
        ->join('subjects', 'firsttermresults.subject_id', 'subjects.id')
        ->orderBy('students.id')
        ->where('firsttermresults.year_id', $year)
        ->where('firsttermresults.form_id', $class)
        ->get();
        return $query;
    }

    public static function getStudentResult($stud_id, $yearId, $termId, $formId){
        $result = [];
        $firstResult = '';
        $secondResult = '';
        $seq1 = '';
        $seq2 = '';
        if($termId == '1'){
            $seq1 = 'First Sequence';
            $seq2 = 'Second Sequence';
        }
        if (Resultcontrol::where('year_id', $yearId)
                ->where('term_id', $termId)
                ->where('seq1_id', '!=', null)
                ->exists()){
            $firstResult = Firsttermresult::
                select('firsttermresults.seq1 as mark',
                        'subjects.name as subject',
                        'subjects.code as code',
                        'forms.name as class',
                        'subclasses.type as type',
                        'firsttermresults.ave_point')
                ->join('subjects', 'subjects.id', 'firsttermresults.subject_id')
                ->join('forms', 'forms.id', 'firsttermresults.form_id')
                ->join('subclasses', 'subclasses.form_id', 'forms.id')
                ->where('firsttermresults.student_id', $stud_id)
                ->where('firsttermresults.form_id', $formId)
                ->where('firsttermresults.year_id', $yearId)
                ->get();
        } else {
            $firstResult = "NO_FIRST_RESULT";
        }

        // second test result
        if (Resultcontrol::where('year_id', $yearId)
                ->where('term_id', $termId)
                ->where('seq2_id', '!=', null)
                ->exists()){
                $secondResult = Firsttermresult::
                select('firsttermresults.seq2 as mark',
                        'subjects.name as subject',
                        'subjects.code as code',
                        'forms.name as class',
                        'subclasses.type as type',
                        'firsttermresults.ave_point')
            ->join('subjects', 'subjects.id', 'firsttermresults.subject_id')
            ->join('forms', 'forms.id', 'firsttermresults.form_id')
            ->join('subclasses', 'subclasses.form_id', 'forms.id')
            ->where('firsttermresults.student_id', $stud_id)
            ->where('firsttermresults.form_id', $formId)
            ->where('firsttermresults.year_id', $yearId)
            ->get();
        } else {
            $secondResult = "NO_SECOND_RESULT";
        }

        $result = [[$firstResult, $seq1], [$secondResult, $seq2]];

        return $result;
    }

    public static function getStudentTest1($stud_id, $class, $year, $subjectId){
        return Firsttermresult::where('student_id', $stud_id)
        ->where('form_id', $class)
        ->where('year_id', $year)
        ->where('subject_id', $subjectId)
        ->first();

    }
    public static function sumSequenceOne($stud_id, $class, $year){
        return Firsttermresult::where('student_id', $stud_id)
        ->where('form_id', $class)
        ->where('year_id', $year)
        ->sum('seq1');

    }
    public static function sumSequenceTwo($stud_id, $class, $year){
        return Firsttermresult::where('student_id', $stud_id)
        ->where('form_id', $class)
        ->where('year_id', $year)
        ->sum('seq2');

    }

}
