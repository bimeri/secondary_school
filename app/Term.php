<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Term extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'name', 'active'
    ];
    public function year(){
        return $this->belongsTo('App\Year');
    }

    public function sequences(){
        return $this->hasMany('App\Sequence');
    }

    public function expensetypes(){
        return $this->hasMany('App\Expensetype');
    }
    public function scholarships(){
        return $this->hasMany('App\Scholarship');
    }
    public function generateresults(){
        return $this->hasMany('App\Generateresult');
    }
    public function studentdisciplines()
    {
        return $this->hasMany('App\Studentdiscipline');
    }
    public function resultcontrols()
    {
        return $this->hasMany('App\Resultcontrol');
    }
    public function studentresults(){
        return $this->hasMany('App\Studentresult');
    }

    public static function getCurrentTerm(){
        $query = Term::select('id')->where('active', 1)->first();
        $id = $query->id;
        return $id;
    }

    public static function getAllTerm(){
        $query = Term::all();
        return $query;
    }

    public static function getTermByName($name){
        return Term::where('name', $name)->first();
    }

    public static function getTermById($id){
        return Term::where('id', $id)->first();
    }
}
