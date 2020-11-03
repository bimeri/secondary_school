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
        $qr = Year::where('id', $id)->first();
        return $qr;
    }
}
