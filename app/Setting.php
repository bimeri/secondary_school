<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'year_id', 'school_name', 'school_id', 'motto', 'logo', 'test_session', 'exam_session', 'start_time', 'break_time', 'stop_time', 'hours_per_period'
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }
    public static function getSchoolMotto(){
        $query = Setting::first();
        return $query->motto;
    }
}
