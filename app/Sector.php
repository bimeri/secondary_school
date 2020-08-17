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

    // public function feetypes(){
    //     return $this->hasMany('App\Feetype');
    // }
}
