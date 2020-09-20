<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subclass extends Model
{
    //
    use Notifiable;
    protected $table = 'subclasses';
    protected $fillable = [
        'form_id', 'type', 'max_number',
    ];

    public function form(){
        return $this->belongsTo('App\Form');
    }

    public function studentinfos(){
        return $this->hasMany('App\Studentinfo');
    }

    public function students(){
        return $this->hasMany('App\Student');
    }

    public static function getStudentBysubClasses($type, $formId){
        $query = Studentinfo::select('studentinfos.id', 'studentinfos.student_id',
                                    'studentinfos.year_id', 'studentinfos.form_id',
                                    'studentinfos.subform_id')
                ->where('studentinfos.form_id', $formId)
                ->join('forms', 'studentinfos.form_id', 'forms.id')
                ->join('subclasses', 'studentinfos.subform_id', 'subclasses.id')
                ->where('subclasses.type', $type)
                ->get();
        return $query;
    }
}
