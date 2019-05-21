<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table="alumno";


    public function getNacimientoAttribute($date) {
      //  return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
        //return Carbon::parse($date)->diffForHumans();
        return  mb_convert_encoding(strftime("%d de %B del %Y", strtotime(date("d-m-Y",strtotime($date)))),  'UTF-8', 'UTF-8');
    }

}
