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

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public static function getTotalFeePaid($year_id, $student_School_id){
        $total = Fee::where('year_id', $year_id)->where('student_school_id', $student_School_id)->sum('amount');
        return $total;
    }
    public static function getStudentYearlyFee($year_id, $form_id, $student_id){
        $feetype = Fee::where('year_id', $year_id)->where('form_id', $form_id)->where('student_id', $student_id)->get();
        return $feetype;
    }

    public static function getStudentYearlyFeeSum($year_id, $form_id, $student_id){
        return Fee::where('year_id', $year_id)
                        ->where('form_id', $form_id)
                        ->where('student_id', $student_id)
                        ->sum('amount');

    }

    public static function getFeeById($id){
        return Fee::where('id', $id)->first();
    }

    public static function getStudentClass($year_id, $student_id){
        $class = Fee::where('year_id', $year_id)->where('student_id', $student_id)->first();
        return $class;
    }

    public static function getYearlyFeeStatistics($year_id){
        $query = Fee::select('*')->where('year_id', $year_id)->get();
        return $query;
    }

    public static function getStudentFees($student_id, $year_id){
        $qr = Fee::select('forms.name as fname', 'forms.id as formId', 'backgrounds.name as bg_name', 'sectors.name as sec_name')
                    ->join('forms', 'forms.id', 'fees.form_id')
                    ->join('backgrounds', 'backgrounds.id', 'forms.background_id')
                    ->join('sectors', 'sectors.id', 'backgrounds.sector_id')
                    ->where('fees.student_id', $student_id)
                    ->where('fees.year_id', $year_id)
                    ->get();
            return $qr;
    }

    public static function getStudentFeeTypeSum($year, $formId, $feetype, $studentId){
        return Fee::where('year_id', $year)
                    ->where('form_id', $formId)
                    ->where('feetype_id', $feetype)
                    ->where('student_id', $studentId)
                ->sum('amount');
    }

    public static function getStudentTotalFeePaid($year,$form, $student_id){
    return Fee::where('year_id', $year)
        ->where('form_id', $form)
        ->where('student_id', $student_id)
        ->sum('amount');
    }
}
