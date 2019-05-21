<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Alumno;
use App\Alumno_curso;
use App\Alumnocalificacion;
use App\Asignatura;
use App\Comportamiento;
use App\Curso;
use App\Cursoasignatura;
use App\DetalleComportamiento;
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
    public function validar_docente_en_curso($curso)
    {
        $ca = Cursoasignatura::where([
            'curso_id' => $curso,
            'docente_id' => $this::docente()->id,
            'activo' => 'S'
        ])->get();

        if (!empty($ca)) {
            return count($ca);
        }
        return 0;
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
            'curso-asignatura.activo' => 'S',
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
    		'docente_id' => $this::docente()->id,
            
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
        //return "kckk";
    	//dd($this::establecimiento());
        // echo "users.id: ".Auth::user()->id.'; <br>';
        // echo "users.id: ".Auth::user()->id;
    	// return  User::select([
    	// 	       'users.id as user_id', 'users.nombres','users.apellido_paterno','users.apellido_materno',
    	// 	       'users.avatar','nch.visto'
    	// 	    ])->join('docente as d','d.user_id','users.id')
    	// 		->join('docente-establecimiento as de','de.docente_id','d.id')
     //            ->leftjoin('notifica_chat as nch','nch.user_envia', 'users.id')
    	// 	    ->where([
    	// 		   	'de.activo' => 'S',
     //                'd.activo' => 'S',
    	// 		   	'de.cuenta_id' => $this::establecimiento()->cuenta_id,
    	//    	    ])->where('users.id','!=', Auth::user()->id)
    	// 	    ->get();
        $s="'S'";
        return DB::select(' SELECT 
               "x"."user_id",
               "x"."nombres",
               "x"."apellido_paterno",
               "x"."apellido_materno",
               "x"."avatar",
               "x"."visto",
               "x"."updated"
        from (SELECT "users"."id" as "user_id", 
                "users"."nombres", 
                "users"."apellido_paterno", 
                "users"."apellido_materno", 
                "users"."avatar", 
                case when "nch"."user_recibe" = '.Auth::user()->id.' then
                    "nch"."visto" else null end as visto,
                "nch"."user_envia", 
                "nch"."user_recibe",
                coalesce("nch"."created_at","d"."updated_at") as updated
                from "users" 
                inner join "docente" as "d" on "d"."user_id" = "users"."id" 
                inner join "docente-establecimiento" as "de" on "de"."docente_id" = "d"."id" 
                left join "notifica_chat" as "nch" on "nch"."user_envia" = "users"."id" and "nch"."user_recibe" ='.Auth::user()->id.' 
                where ("de"."activo" = '.$s.' and "d"."activo" = '.$s.' and "de"."cuenta_id" = '.$this::establecimiento()->cuenta_id.') 
                and "users"."id" !='.Auth::user()->id.') as x order by updated desc');


    	
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
    	->join('curso-asignatura as ca','ca.id','recordatorio.curso_asignatura_id')
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
    public function desactiviar_record($record)
    {
    	$ac = Actividad::find($record);
    	$ac->activo = "N";
    	if($ac->save()){
    		return "true";
    	}
    }
    public function activiar_record($record)
    {
    	$ac = Actividad::find($record);
    	$ac->activo = "S";
    	if($ac->save()){
    		return "true";
    	}
    }

    public function listar_ap_y_doc($curso, $asignatura)
    {
        $valida = $this::validar_docente_en_curso_y_asignatura($curso, $asignatura);

        if ($valida) {
            
           $alumno =  Alumno::select([
                        'alumno.id',
                        'alumno.nombre',
                        'alumno.apellido_paterno',
                        'alumno.apellido_materno',
                        'ca.curso_id','ca.asignatura_id'
                    ])
                   ->join('alumno-curso as ac', 'ac.alumno_id','alumno.id')
                   ->join('curso-asignatura as ca','ca.curso_id','ac.curso_id') 
                   ->where([
                        'ca.docente_id' => $this::docente()->id,
                        'ca.curso_id' => $curso, 'ca.asignatura_id' => $asignatura, 'ac.activo' => 'S'
                   ])
                   ->orderBy('alumno.apellido_paterno')
                   ->get();

            foreach ($alumno as $a) {
                //dump($a->id);
                 $a['apoderado'] = User::join('alumno_apoderado as aa','aa.user_id','users.id')
                                  ->where([
                                    'aa.alumno_id' => $a->id,
                                    'aa.activo' => 'S'
                                  ])->get();
                                  //return $a;
            }


            return $alumno;
        }

    }
    public function ver_comportamiento($alumno, $curso, $seccion)
    {


        if ($this::validar_docente_en_curso($curso) > 0) {
            # code...
        
            $datos = Alumno::select([
                        'u.id as user_doc_id',
                        'd.id as docente_id',
                        'u.nombres','u.apellido_paterno','u.apellido_materno',
                        'alumno.nombre as a_nombre','alumno.apellido_paterno as a_ap_p',
                        'alumno.apellido_materno as a_ap_m', 'alumno.id as alumno_id',
                        'c.descripcion as curso','c.promocion','c.nivel_educativo', 'c.id as curso_id',
                        'c.formato_id'

            ])->join('alumno-curso as ac','ac.alumno_id','alumno.id')
                           ->join('curso as c','c.id','ac.curso_id')
                           ->join('curso-asignatura as ca','ca.curso_id','c.id')
                           ->join('docente as d','d.id','ca.docente_id')
                           ->join('users as u','u.id','d.user_id')
                           ->where([
                              'alumno.id' => $alumno,
                              'ca.docente_id' => $this::docente()->id,
                              'ca.jefe_curso' => 'S'
                           ])->get();

            $comp = Comportamiento::select([
                            'id','activo','descripcion'
                    ])->where([
                        'comportamiento.cuenta_id' => $this::establecimiento()->cuenta_id,
                        'comportamiento.activo' => 'S'
                   ])->get();
            foreach ($comp as $key) {
                $key['nivel'] = DB::table('comportamiento_nivel as cn')
                                ->select([
                                        'nivel_educativo_id','descripcion as nivel'
                                ])
                ->join('nivel_educativo as ne','ne.id','cn.nivel_educativo_id')->where([
                        'cn.comportamiento_id' => $key->id,
                        'ne.activo' => 'S'
                    ])->get();
            }


            foreach ($comp as $com) {
                $exist = DetalleComportamiento::where([
                    'comportamiento_id' => $com->id,
                    'alumno_id' => $alumno,
                    'curso_id' => $curso,
                    'docente_id' => $this::docente()->id,
                    'seccion' => $seccion,
                    'activo' => 'S'
                ])->first();

                if ($exist) {
                    $com['existe'] = 'S';
                    $com['value'] = $exist->descripcion;
                }else{
                    $com['existe'] = 'N';
                    $com['value'] = '';
                }
            }


            return [
                $datos,
                $comp
            ];
        }
    }

    public function asignar_comportamiento(Request $r)
    {   
        $exist = DetalleComportamiento::where([
                    'comportamiento_id' => $r->comportamiento,
                    'alumno_id' => $r->alumno,
                    'curso_id' => $r->curso,
                    'docente_id' => $this::docente()->id,
                    'seccion' => $r->seccion,
                    'activo' => 'S'
                ])->first();

        if($exist){
            $exist->descripcion = $r->criterio;
            if ($exist->save()) {
                return[
                        'tipo' => 'success', 'mensaje'=>'Comportamiento actualizado'
                    ];
            }
            return[
                        'tipo' => 'error', 'mensaje'=>'Error al actualizar'
            ];
        }
        else{

                $dc = new DetalleComportamiento;
                $dc->comportamiento_id = $r->comportamiento;
                $dc->alumno_id = $r->alumno;
                $dc->curso_id = $r->curso;
                $dc->docente_id = $r->docente;
                $dc->activo = "S";
                $dc->descripcion = $r->criterio;
                $dc->seccion = $r->seccion;
                if ($dc->save()) {
                    return[
                        'tipo' => 'success', 'mensaje'=>'Comportamiento asignado'
                    ];
                }
                return['tipo'=>'error','mensaje'=>'No fue posible realizar guardado'];
        }
    }

    public function ver_notas_prof_jefe($alumno, $curso, $seccion)
    {
        if ($this::validar_docente_en_curso($curso) > 0) {

            // $ac = Alumno::join('alumno-calificacion as ac','ac.alumno_id','alumno.id')
            //             ->join('asignatura as a','a.id','ac.asignatura_id')
            //             ->where([
            //                 'ac.alumno_id' => $alumno,
            //                 'ac.curso_id' => $curso,
            //                 'ac.seccion' => 1
            //             ])->get();
            // return $ac;

            // return Asignatura::leftjoin('alumno-calificacion as ac','ac.asignatura_id','asignatura.id')
            //                  ->leftjoin('alumno as a','a.id','ac.alumno_id')
            //         ->where([
            //                 'ac.alumno_id' => $alumno,
            //                 'ac.curso_id' => $curso,
            //                 'ac.seccion' => 1
            //             ])->get();


            $asignaturas = DB::select('SELECT 
                    asi.id as asignatura_id,
                    asi.descripcion as asignatura,
                    c.id as curso_id,
                    c.descripcion as curso,
                    ac.alumno_id
                    
                from "asignatura" as asi
                left join "curso-asignatura" as "cuas" on "cuas"."asignatura_id" = "asi"."id"
                left join "curso" as "c" on "c"."id" = "cuas"."curso_id"
                left join "alumno-curso" as "ac" on "ac"."curso_id" = "c"."id"
                --left join "alumno-calificacion" as "alca" on "alca"."alumno_id" = "ac"."alumno_id"
                where "ac"."alumno_id" = '.$alumno.' and "c"."id" = '.$curso.' order by asi.descripcion asc');

            foreach ($asignaturas as $as) {
                $as->notas = Alumnocalificacion::where([
                    'alumno_id' => $alumno,
                    'curso_id' => $curso,
                    'asignatura_id' => $as->asignatura_id,
                    'seccion' => $seccion
                ])->first();
            }

            return $asignaturas;

        }
    }

    public function alumnos($curso, $asignatura)
    {
         $valida = $this::validar_docente_en_curso_y_asignatura($curso, $asignatura);

        if ($valida) {
            
           $alumno =  Alumno::select([
                        'alumno.id',
                        'alumno.nombre',
                        'alumno.apellido_paterno',
                        'alumno.apellido_materno',
                        'ca.curso_id','ca.asignatura_id'
                    ])
                   ->join('alumno-curso as ac', 'ac.alumno_id','alumno.id')
                   ->join('curso-asignatura as ca','ca.curso_id','ac.curso_id') 
                   ->where([
                        'ca.docente_id' => $this::docente()->id,
                        'ca.curso_id' => $curso, 'ca.asignatura_id' => $asignatura, 'ac.activo' => 'S'
                   ])
                   ->orderBy('alumno.apellido_paterno')
                   ->get();

            return $alumno;
        }
    }
}

// id_envia: 15
// id_recibe: 33
// message: "hola pipe"