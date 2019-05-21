<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GeneralController extends Controller
{
    public function nivel_educativo()
    {
    	return DB::table('nivel_educativo')->where('activo','S')->get();
    }
    public function anio()
    {
    	return DB::table('anio')->orderBy('anio','desc')->where('activo','S')->get();
    }
    public function cursos($anio)
    {
    	
    }
}
