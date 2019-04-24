<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Alumno_curso;
use App\Alumnocalificacion;
use App\Asignatura;
use App\Curso;
use App\Cursoasignatura;
use App\Docente;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{

	public function docente()
	{
		return Docente::where('user_id', Auth::user()->id)->first();
	}
	public function establecimiento()
	{
		return DB::table('docente-establecimiento')->select('cuenta_id')->where( 'docente_id',$this::docente()->id)
		->first();
		# code...
	}

	public function validar_docente_en_curso_y_asignatura($curso, $asignatura)
	{
		$ca = Cursoasignatura::where([
    		'curso_id' => $curso,
    	    'asignatura_id' => $asignatura,
    		'docente_id' => $this::docente()->id,
    		'activo' => 'S'
    	])->first();

    	if (!empty($ca)) {
    		return $ca;
    	}
    	return null;
	}

    public function profesor_jefe()
    {
    	$jefe = Cursoasignatura::select([
    			'c.id as curso_id',
    			'c.descripcion',
    			'c.nivel_educativo',
    			'c.promocion',
    			'c.cuenta_id'
    	])
    	->join('curso as c','c.id','curso-asignatura.curso_id')
    	->where([
    		'docente_id'=> $this::docente()->id,
    		'jefe_curso'=> 'S',
    		'c.promocion' => date("Y")
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
    	$docente = Docente::where('user_id', Auth::user()->id)->first();
    	return Alumnocalificacion::traer_notas($curso, $asignatura, $seccion, $docente->id);
    }

    public function registrar_nota(Request $r)
    {
    	return Alumnocalificacion::registrar_nota($r);
    }

    public function registrar_actividad(Request $r)
    {


    	$valida = $this::validar_docente_en_curso_y_asignatura($r->curso, $r->asignatura);
    	//dd($valida);
    	if ($valida != null) {
    		$recordatorio = new Actividad;
	    	$recordatorio->titulo = $r->titulo;
	    	$recordatorio->descripcion = $r->descripcion;
	        $recordatorio->fecha = date("Y-m-d",strtotime($r->fecha));
	        $recordatorio->curso_id = $r->curso;
	        $recordatorio->asignatura_id = $r->asignatura;
	        $recordatorio->activo = "S";
	        $recordatorio->curso_asignatura_id = $valida->id;
	        if ($recordatorio->save()) {
	        	 return [
	        	 	'tipo' => 'success', 'mensaje' => 'Actividad registrada'
	        	 ];
	        }else{
	        	return [
	        	 	'tipo' => 'error', 'mensaje' => 'Error al registrar'
	        	 ];
	        }
    	}else{
    		return [
	        	 	'tipo' => 'error', 'mensaje' => 'Error al registrar'
	        	 ];
    	}

    	
    }
    public function listar_actividad($curso, $asignatura)
    {
    	setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
		setlocale(LC_TIME, 'spanish');
    	$cabeza = Actividad::select('fecha')->where([
    		'curso_id' => $curso, 'asignatura_id' => $asignatura, 'activo' => 'S'
    	])->distinct('fecha')->orderBy('fecha','desc')->get();
    	
    	$cuerpo = [];
    	$sum=0;
    	$array_return = [];

    	foreach ($cabeza as $key) {
    		 $cuerpo[$sum] = Actividad::where([
    							'curso_id' => $curso, 'asignatura_id' => $asignatura, 'fecha' => $key->fecha, 'activo' => 'S'
    						])->orderBy('created_at','desc')->get();
    		 $i=0;
    		 foreach ($cuerpo[$sum] as $cu) {
    		 	$cu->cuando = Carbon::parse($cu->created_at)->diffForHumans();
    		 	//$cu->created_at = Carbon::parse('2019-04-15 00:40:52')->diffForHumans();
    		 }


    		  //$array_return[]['cabeza']['fecha'] = date("d-m-Y",strtotime($key->fecha));
    		 $array_return[]['cabeza']['fecha'] = mb_convert_encoding(strftime("%d de %B del %Y", strtotime(date("d-m-Y",strtotime($key->fecha)))),  'UTF-8', 'UTF-8');
    		 $array_return[$sum]['cuerpo'] = $cuerpo[$sum];
    		 
    		 $sum++;
    	}
    	return response()->json($array_return);
    }
    public function listar_docentes_colegio()
    {
    	//dd($this::establecimiento());

    	return  User::select([
    		       'users.id as user_id', 'users.nombres','users.apellido_paterno','users.apellido_materno',
    		       'users.avatar'
    		    ])->join('docente as d','d.user_id','users.id')
    			->join('docente-establecimiento as de','de.docente_id','d.id')
    		    ->where([
    			   	'de.activo' => 'S',
    			   	'de.cuenta_id' => $this::establecimiento()->cuenta_id,
    	   	    ])->where('users.id','!=', Auth::user()->id)
    		    ->get();
    	
    }

    public function listar_alumnos_jcurso($curso)
    {
    	if (empty($curso)) {
    		return false;
    	}
    	return Alumno_curso::docente_obtener_alumnos($this::establecimiento()->cuenta_id, $curso, $this::docente()->id);
    }
    public function actividad_general()
    {
    	$cabeza = Actividad::select('recordatorio.fecha')
    	->join('curso-asignatura as ca','ca.asignatura_id','recordatorio.asignatura_id')
    	->where([
    		'ca.docente_id' => $this::docente()->id,
    		//'recordatorio.activo' => 'S'
    	])->distinct('fecha')->orderBy('fecha','desc')->get();

    	$cuerpo = [];
    	$n= [];
    	$s=[];
    	$sum=0;
    	$array_return = [];

    	foreach ($cabeza as $key) {
    		 $cuerpo[$sum] = Actividad::select([
    		 	'ca.curso_id', 'ca.asignatura_id','ca.docente_id','recordatorio.id as recordatorio_id',
    		 	'recordatorio.titulo','recordatorio.descripcion','recordatorio.activo','recordatorio.created_at',
    		 	'c.descripcion as curso','c.nivel_educativo','a.descripcion as asignatura'
    		 ])
    		 ->join('curso as c','c.id','recordatorio.curso_id')
    		 ->join('asignatura as a','a.id','recordatorio.asignatura_id')
    		 ->join('curso-asignatura as ca','ca.id','recordatorio.curso_asignatura_id')
    		 ->where([
    				'ca.docente_id' => $this::docente()->id,'fecha' => $key->fecha, /*'recordatorio.activo' => 'S'*/
    		])->orderBy('recordatorio.created_at','desc')->get();
    		 //return $cuerpo[$sum];

    		 $n[$sum] = Actividad::select([
    		 	'ca.curso_id', 'ca.asignatura_id','ca.docente_id','recordatorio.id as recordatorio_id',
    		 	'recordatorio.titulo','recordatorio.descripcion','recordatorio.activo','recordatorio.created_at',
    		 	'c.descripcion as curso','c.nivel_educativo','a.descripcion as asignatura'
    		 ])
    		 ->join('curso as c','c.id','recordatorio.curso_id')
    		 ->join('asignatura as a','a.id','recordatorio.asignatura_id')
    		 ->join('curso-asignatura as ca','ca.id','recordatorio.curso_asignatura_id')
    		 ->where([
    				'ca.docente_id' => $this::docente()->id,'fecha' => $key->fecha, 'recordatorio.activo' => 'N'
    		])->orderBy('recordatorio.created_at','desc')->get();
    		 $s[$sum] = Actividad::select([
    		 	'ca.curso_id', 'ca.asignatura_id','ca.docente_id','recordatorio.id as recordatorio_id',
    		 	'recordatorio.titulo','recordatorio.descripcion','recordatorio.activo','recordatorio.created_at',
    		 	'c.descripcion as curso','c.nivel_educativo','a.descripcion as asignatura'
    		 ])
    		 ->join('curso as c','c.id','recordatorio.curso_id')
    		 ->join('asignatura as a','a.id','recordatorio.asignatura_id')
    		 ->join('curso-asignatura as ca','ca.id','recordatorio.curso_asignatura_id')
    		 ->where([
    				'ca.docente_id' => $this::docente()->id,'fecha' => $key->fecha, 'recordatorio.activo' => 'S'
    		])->orderBy('recordatorio.created_at','desc')->get();
    		 $i=0;
    		 foreach ($cuerpo[$sum] as $cu) {
    		 	$cu->cuando = Carbon::parse($cu->created_at)->diffForHumans();
    		 	//$cu->created_at = Carbon::parse('2019-04-15 00:40:52')->diffForHumans();
    		 }


    		  //$array_return[]['cabeza']['fecha'] = date("d-m-Y",strtotime($key->fecha));
    		 $array_return[]['cabeza']['fecha'] = mb_convert_encoding(strftime("%d de %B del %Y", strtotime(date("d-m-Y",strtotime($key->fecha)))),  'UTF-8', 'UTF-8');
    		 $array_return[$sum]['cuerpo'] = $cuerpo[$sum];
    		 $array_return[$sum]['s'] = count($s[$sum]);
    		 $array_return[$sum]['n'] = count($n[$sum]);
    		 $array_return[$sum]['porcentaje'] =$array_return[$sum]['n']!=0?($array_return[$sum]['n']*100)/($array_return[$sum]['n'] + $array_return[$sum]['s']):0;
    		 $sum++;
    	}
    	return response()->json($array_return);
    }
}
