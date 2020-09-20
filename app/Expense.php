<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Expense extends Model
{
    //
    use Notifiable;
    protected $table = 'expenses';
    protected $fillable = [
        'name'
    ];

    public static function getAllType(){
        return Expense::all();
    }
    public function expenseType(){
        return $this->hasMany('App\Expensetype');
    }
}
