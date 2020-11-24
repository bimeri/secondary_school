<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Year extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'name', 'active'
    ];

    public function terms()
    {
        return $this->hasMany('App\Term');
    }

    public function settings()
    {
        return $this->hasMany('App\Setting');
    }

    public function feetypes()
    {
        return $this->hasMany('App\Feetype');
    }
    public function expensetypes()
    {
        return $this->hasMany('App\Expensetype');
    }
    public function scholarships()
    {
        return $this->hasMany('App\Scholarship');
    }
    public function fees()
    {
        return $this->hasMany('App\Fee');
    }
    public function studentinfos()
    {
        return $this->hasMany('App\Studentinfo');
    }
    public function feeecontrols()
    {
        return $this->hasMany('App\Feecontrol');
    }
    public function studentdisciplines()
    {
        return $this->hasMany('App\Studentdiscipline');
    }
    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function promotions(){
        return $this->hasMany('App\Promotion');
    }

    public function firsttermresults(){
        return $this->hasMany('App\Firsttermresult');
    }

    public function resultcontrols(){
        return $this->hasMany('App\Resultcontrol');
    }

    public function assignments(){
        return $this->hasMany('App\Assignment');
    }

    public function studentresults(){
        return $this->hasMany('App\Studentresult');
    }

    public function generateresults(){
        return $this->hasMany('App\Generateresult');
    }

    public static function getCurrentYear()
    {
        $query = Year::select('id')->where('active', 1)->first();
        $id = $query->id;
        return $id;
    }
    public static function getYearName($year_id)
    {
        $query = Year::select('name')->where('id', $year_id)->first();
        $n = $query->name;
        return $n;
    }

    public static function getAllYear()
    {
        $qr = Year::all();
        return $qr;
    }

    public static function getCurrentAcademicYear()
    {
        return Year::where('active', 1)->first();

    }

    public static function getYear($id)
    {
        return Year::where('id', $id)->first();
    }
}
