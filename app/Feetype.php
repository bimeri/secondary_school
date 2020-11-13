<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feetype extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'form_id', 'fee_type', 'amount',
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function fees(){
        return $this->hasMany('App\Fee');
    }

    public static function getAllFeesPerClassAndYear($year_id, $form_id){
        $feetype = Feetype::where('year_id', $year_id)->where('form_id', $form_id)->sum('amount');
        return $feetype;
    }

    public static function getCurrentYearformFee($year_id, $form_id){
        $feetype = Feetype::where('year_id', $year_id)->where('form_id', $form_id)->get();
        $cc = array();
        foreach ($feetype as $type) {
            $type = "<option value=".$type->id.">".$type->fee_type."/".$type->amount."</option>";
            array_push($cc, $type);
        }
        return $cc;
    }

    public static function SumClassFeePerYear($form, $year){
     return   Feetype::where('form_id', $form)->where('year_id', $year)->sum('amount');
    }

    public static function getFeeTypeById($id){
     return   Feetype::where('id', $id)->first();
    }

    public static function getFeeTypeName($id){
     $qr = Feetype::where('id', $id)->first();
     return $qr->fee_type;
    }

    public static function getclasssFeePerYear($year, $class){
     $qr = Feetype::where('year_id', $year)->where('form_id', $class)->get();
     return $qr;
    }
}
