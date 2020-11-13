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
                                         'seq3', 'seq4', 'ave_point as points',
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

    public static function getStudentResult($stud_id, $yearId, $termId, $formId){
        $result = [];
        $firstResult = '';
        $secondResult = '';
        $seq1 = '';
        $seq2 = '';
        if($termId == '1'){
            $seq1 = 'Third Sequence';
            $seq2 = 'Fourth Sequence';
        }
        if (Resultcontrol::where('year_id', $yearId)
                ->where('term_id', $termId)
                ->where('seq1_id', '!=', null)
                ->exists()){
            $firstResult = Secondtermresult::select('secondtermresults.seq3 as mark',
                                                   'subjects.name as subject',
                                                   'subjects.code as code',
                                                   'forms.name as class',
                                                   'subclasses.type as type',
                                                   'secondtermresults.ave_point')
                                            ->join('subjects', 'subjects.id', 'secondtermresults.subject_id')
                                            ->join('forms', 'forms.id', 'secondtermresults.form_id')
                                            ->join('subclasses', 'subclasses.form_id', 'forms.id')
                                            ->where('secondtermresults.student_id', $stud_id)
                                            ->where('secondtermresults.form_id', $formId)
                                            ->where('secondtermresults.year_id', $yearId)
                                            ->get();
        } else {
            $firstResult = "NO_FIRST_RESULT";
        }

        // second test result
        if (Resultcontrol::where('year_id', $yearId)
                ->where('term_id', $termId)
                ->where('seq2_id', '!=', null)
                ->exists()){
            $secondResult = Secondtermresult::select('secondtermresults.seq4 as mark',
                                                    'subjects.name as subject',
                                                    'subjects.code as code',
                                                    'forms.name as class',
                                                    'subclasses.type as type',
                                                    'secondtermresults.ave_point')
                                        ->join('subjects', 'subjects.id', 'secondtermresults.subject_id')
                                        ->join('forms', 'forms.id', 'secondtermresults.form_id')
                                        ->join('subclasses', 'subclasses.form_id', 'forms.id')
                                        ->where('secondtermresults.student_id', $stud_id)
                                        ->where('secondtermresults.form_id', $formId)
                                        ->where('secondtermresults.year_id', $yearId)
                                        ->get();
        } else {
            $secondResult = "NO_SECOND_RESULT";
        }

        $result = [[$firstResult, $seq1], [$secondResult, $seq2]];

        return $result;
    }
}
