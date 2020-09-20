<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expensetype extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'expense_id', 'amount', 'reason',
    ];

    public function year(){
        return $this->belongsTo('App\Year');
    }
    public function term(){
        return $this->belongsTo('App\Term');
    }

    public function expense(){
        return $this->belongsTo('App\Expense');
    }

    public static function getCurrentYearInfo($year){
        $q = Expensetype::where('year_id', $year)
                        ->get();
        return $q;
    }

    public static function getSumAmount($year){
        return Expensetype::where('year_id', $year)->sum('amount');
    }

    public static function getYearlyAmountPerExpense($year, $expense){
       return Expensetype::where('year_id', $year)->where('expense_id', $expense)->sum('amount');
    }
    public static function getYearlyDetailPerExpense($year, $expense){
       return Expensetype::where('year_id', $year)->where('expense_id', $expense)->get();
    }
}
