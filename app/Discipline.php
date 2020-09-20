<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Discipline extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'type', 'description'
    ];
    public function studentdisciplines(){
        return $this->hasMany('App\Studentdiscipline');
    }

    public static function getalldisciplineType(){
        $query = Discipline::all();
        return $query;
    }
}
