<?php

namespace App\Http\Controllers;

use App\Cursoasignatura;
use App\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
	public function docente()
	{
		return Docente::where('user_id', Auth::user()->id)->first();
	}
    public function profesor_jefe()
    {
    	$jefe = Cursoasignatura::select([
    			'c.id as curso_id',
    			'c.descripcion',
    			'c.promocion',
    			'c.cuenta_id'
    	])
    	->join('curso as c','c.id','curso-asignatura.curso_id')
    	->where([
    		'docente_id'=> $this::docente()->id,
    		'jefe_curso'=> 'S'
    	])->get();

    	if (count($jefe)>0) {


    		return [
    			'tipo' => 'success',
    			'cantidad' => count($jefe),
    			'cursos' => $jefe
    		];
    	}
    	return [
    			'tipo' => 'error',
    			'cantidad' => null,
    			'cursos' => null
    		];
    }

    public function mis_cursos()
    {
    	return  Cursoasignatura::select([
    			'c.id as curso_id',
    			'c.descripcion',
    			'c.promocion',
    			'c.cuenta_id',
    			'c.formato_id'
    	])
    	->join('curso as c','c.id','curso-asignatura.curso_id')
    	->where([
    		'docente_id'=> $this::docente()->id,
    		'c.activo' => 'S'
    		//'jefe_curso'=> 'S'
    	])->get();
    }
}
