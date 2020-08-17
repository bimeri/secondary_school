<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fee extends Model
{
    //
    use Notifiable;
    //public $guard = 'admin';
    protected $fillable = [
        'year_id', 'feetype_id', 'student_id', 'form_id', 'student_school_id', 'amount', 'payment_method', 'balance', 'status'
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function feetype(){
        return $this->belongsTo('App\Feetype');
    }
    public function form(){
        return $this->belongsTo('App\Form');
    }

    public static function getTotalFeePaid($year_id, $student_School_id){
        $total = Fee::where('year_id', $year_id)->where('student_school_id', $student_School_id)->sum('amount');
        return $total;
    }
    public static function getStudentYearlyFee($year_id, $form_id, $student_id){
        $feetype = Fee::where('year_id', $year_id)->where('form_id', $form_id)->where('student_id', $student_id)->get();
        return $feetype;
    }
    public static function getStudentClass($year_id, $student_id){
        $class = Fee::where('year_id', $year_id)->where('student_id', $student_id)->first();

        return $class;
    }

    public static function getYearlyFeeStatistics($year_id){
        $query = Fee::select('*')->where('year_id', $year_id)->get();
        return $query;
    }
}
