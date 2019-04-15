<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Alumnocalificacion;
use App\Asignatura;
use App\Curso;
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
    			'c.formato_id',
    			'a.descripcion as asignatura',
    			'a.id as asignatura_id'
    	])
    	->join('curso as c','c.id','curso-asignatura.curso_id')
    	->join('asignatura as a','a.id','curso-asignatura.asignatura_id')
    	->where([
    		'docente_id'=> $this::docente()->id,
    		'c.activo' => 'S',
    		'a.activo' => 'S'
    		//'jefe_curso'=> 'S'
    	])->get();
    }

    public function datos_basicos($curso, $asignatura)
    {
    	$db_curso = Curso::find($curso);
    	$db_asignatura = Asignatura::find($asignatura);

    	$ca = Cursoasignatura::where([
    		'curso_id' => $curso,
    	    'asignatura_id' => $asignatura,
    		'docente_id' => $this::docente()->id
    	])->first();

    	return [
    		'curso'=>$db_curso,
    		'asignatura'=>$db_asignatura,
    		'ca' => $ca
    	];
    }

    public function libro_notas($curso, $asignatura, $seccion)
    {
    	return Alumnocalificacion::traer_notas($curso, $asignatura, $seccion);
    }

    public function registrar_nota(Request $r)
    {
    	return Alumnocalificacion::registrar_nota($r);
    }

    public function registrar_actividad(Request $r)
    {
    	$recordatorio = new Actividad;
    	$recordatorio->titulo = $r->titulo;
    	$recordatorio->descripcion = $r->descripcion;
        $recordatorio->fecha = date("Y-m-d",strtotime($r->fecha));
        $recordatorio->curso_id = $r->curso;
        $recordatorio->asignatura_id = $r->asignatura;
        $recordatorio->activo = "S";
        if ($recordatorio->save()) {
        	 return [
        	 	'tipo' => 'success', 'mensaje' => 'Actividad registrada'
        	 ];
        }else{
        	return [
        	 	'tipo' => 'error', 'mensaje' => 'Error al registrar'
        	 ];
        }
    }
    public function listar_actividad($curso, $asignatura)
    {
    	$cabeza = Actividad::select('fecha')->where([
    		'curso_id' => $curso, 'asignatura_id' => $asignatura
    	])->distinct('fecha')->get();
    	
    	$cuerpo = [];
    	$sum=0;
    	$array_return = [];

    	foreach ($cabeza as $key) {
    		 $cuerpo[$sum] = Actividad::where([
    							'curso_id' => $curso, 'asignatura_id' => $asignatura, 'fecha' => $key->fecha
    						])->get();
    		  $array_return[]['cabeza']['fecha'] = date("d-m-Y",strtotime($key->fecha));
    		 $array_return[$sum]['cuerpo'] = $cuerpo[$sum];

    		 $sum++;
    	}
    	return $array_return;
    }
}
