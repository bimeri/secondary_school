<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    //
    use Notifiable;
    protected $table = 'assignments';
    protected $fillable = [
        'teacher_id', 'subject_id', 'name', 'year_id', 'text', 'create_date', 'status'
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
    public static function getTeacherAssigment($user_id, $subject_id){
        return Assignment::where('teacher_id', $user_id)->where('subject_id', $subject_id)->get();
    }

    public static function getTeachersPreviewAssignment($user_id, $subject_id, $assignment_id, $year_id){
        return Assignment::where('teacher_id', $user_id)
                            ->where('subject_id', $subject_id)
                            ->where('id', $assignment_id)
                            ->where('year_id', $year_id)->first();
    }
}
