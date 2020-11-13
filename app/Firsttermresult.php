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
    public function year(){
        return $this->belongsTo('App\Year');
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
            $firstResult = Firsttermresult::select('firsttermresults.seq1 as mark',
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
            $secondResult = Firsttermresult::select('firsttermresults.seq2 as mark',
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
}
