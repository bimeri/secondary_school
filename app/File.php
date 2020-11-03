<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class File extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'subject_id', 'teacher_id', 'file_name', 'file_path', 'file_type'
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

    public static function getTeachersFiles($yearId, $teacherId, $SubjectId){
        return File::where('year_id', $yearId)->where('teacher_id', $teacherId)->where('subject_id', $SubjectId)->get();
    }

    public static function getFileDetail($fileId){
        return File::where('id', $fileId)->first();
    }
}
