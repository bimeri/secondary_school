<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sector extends Model
{
    //
    use Notifiable;

   protected $fillable = [
       'name', 'description'
   ];

   public function backgrounds(){
        return $this->hasMany('App\Background');
    }

    public static function getAllType(){
        return Sector::all();
    }

    public static function getName($sectorId){
        $query = Sector::where('id', $sectorId)->first();
        if($query){
            return $query->name;
        } else {
            return '';
        }
    }

    // public function feetypes(){
    //     return $this->hasMany('App\Feetype');
    // }
}
