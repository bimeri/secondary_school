<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Promotion extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'form_id', 'student_id', 'form_type', 'remark'
    ];

    public function student(){
        return $this->belongsTo('App\Student');
    }
    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }

    public static function getStudentcurrentClass($yearid, $studentId, $formid){
        return Promotion::where('year_id', $yearid)
                        ->where('student_id', $studentId)
                        ->where('form_id', $formid)->first();
    }

    public static function getStudentPerClassAndYear($year, $class){
        return Promotion::where('year_id', $year)->where('form_id', $class)->get();
    }
}
