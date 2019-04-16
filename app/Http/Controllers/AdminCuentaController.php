<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Alumno_curso;
use App\Asignatura;
use App\Curso;
use App\Cursoasignatura;
use App\Docente;
use App\User;
use App\cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Avatar;

class AdminCuentaController extends Controller
{
	public function _cuenta()
	{
		 return DB::table('cuentas_users')->where('user_id', Auth::user()->id)->first();
	}
    public function crear_curso(Request $r)
    {
    	
    	// dd(!empty($r->docente)? $r->docente['name'] : 'null');

    	$curso = new Curso;
    	$curso->descripcion = strtoupper($r->descripcion);
    	$curso->user_id = !empty($r->docente)? $r->docente['name'] : null;
    	$curso->promocion = $r->promocion;
    	$curso->cuenta_id = $this::_cuenta()->cuenta_id;
    	$curso->formato_id = $r->formato;
    	$curso->activo = "S";
    	if ($curso->save()) {
    		return "success";
    	}
    }

    public function listar_curso()
    {
    	return Curso::where('cuenta_id', $this::_cuenta()->cuenta_id)->get();
    }
    public function obtener_cursos()
    {
    	return Curso::where('cuenta_id', $this::_cuenta()->cuenta_id)->where('activo','S')->get();
    }
    public function perfil_curso($curso)
    {
    	return Curso::where('cuenta_id', $this::_cuenta()->cuenta_id)
    		   ->where('id', $curso)
    	       ->where('activo','S')->first();
    }
    public function aleatorio_colors(){
        $array =  Array('#F5B041','#EC7063','#B2BABB','#45B39D','#BB8FCE','#3498DB','#5D6D7E');
        $rand = random_int ( 0 , 6 );
        return $array[$rand];
    } 
    public function crearDocente(Request $r)
    {
        $avatar = new Avatar;

        $uriAvatar = 'storage/user_avatar/'.time().'.png';
       // $urlBack = 'background/'.time().'-'.$request->email.'.png';
        $nombre_letra = substr($r->nombre,0,1);
        $avatar->create(strtoupper($nombre_letra))->setBackground($this->aleatorio_colors())->save($uriAvatar, $quality = 90);

    	$user = new User;
    	$user->nombres = $r->nombre;
    	$user->apellido_paterno = $r->apellido_p;
    	$user->apellido_materno = $r->apellido_m;
    	$user->email = $r->email;
    	$user->rol_id = '3';
    	$user->sexo = $r->sexo;
    	$user->password = bcrypt($r->password);
        $user->avatar = $uriAvatar;

    	if ($user->save()) {
    		$docente = new Docente;
    		$docente->user_id = $user->id;
    		$docente->run = $r->run;
    		$docente->dv = $r->dv;
    		$docente->fecha_nacimiento = date("Y-m-d",strtotime($r->nacimiento));
    		$docente->contacto = $r->contacto;
    		$docente->activo = 'S';
    		if ($docente->save()) {
    			DB::table('docente-establecimiento')->insert([
    				'docente_id'=> $docente->id,
    				'cuenta_id' => $this::_cuenta()->cuenta_id,
    				'activo' => 'S'
    			]);

    			return "success";
    		}
    	}
    }
     public function obtener_docentes()
    {
    	return User::join('docente as d','d.user_id','users.id')
    	           ->join('docente-establecimiento as de','de.docente_id','d.id')
    	           ->where('de.cuenta_id', $this::_cuenta()->cuenta_id)->get();
    	      
    }

    public function crearAlumno(Request $r)
    {
    	
    	$a = new Alumno;
    	$a->run = $r->run;
    	$a->nombre = $r->nombre;
    	$a->apellido_paterno = $r->apellido_p;
    	$a->apellido_materno = $r->apellido_m;
    	$a->sexo = $r->sexo = $r->sexo;
    	$a->direccion = $r->direccion;
    	$a->nacimiento = date("Y-m-d",strtotime($r->nacimiento));
    	$a->activo = "S";

    	if ($a->save()) {
    		if (!empty($r->curso)) {
    			$ac = new Alumno_curso;
    			$ac->alumno_id = $a->id;
    			$ac->curso_id = $r->curso;
    			$ac->activo = 'S';
	    		$ac->anio_actual = 'S';
	    		if ($ac->save()) {
	    			return "success";
	    		}
	    		
    		}

    		return "success";
    	}

    	
    }
    public function obtener_alumnos()
    {
    	return Alumno_curso::admin_obtener_alumnos($this::_cuenta()->cuenta_id);
    }
     public function obtener_alumnos_filter($curso)
    {
    	if (empty($curso)) {
    		return false;
    	}
    	return Alumno_curso::admin_obtener_alumnos($this::_cuenta()->cuenta_id, $curso);
    }

    public function obtener_asignaturas()
    {
    	return Asignatura::all();
    }

    public function agregarasignatura(Request $r)
    {
    	
    	$verify = Cursoasignatura::where([
    			'curso_id' => $r->curso,
    			'asignatura_id' => $r->asignatura,
    			// 'docente_id' => $r->docente
    	])->get();
    	// dd(count($verify) > 0);

    	if (count($verify) > 0) {
    		return "exists";
    	}else{

    		$exist_jefe = Cursoasignatura::where([
    		'curso_id' => $r->curso,
    		// 'docente_id' => $r->docente,
    		'jefe_curso' => 'S'
	    	])->first();

	    	if (!empty($exist_jefe) && $r->jefe == true) {// si el jefe de curso es false
	    		return "exist_jefe";
	    	}
		    		$ca = new Cursoasignatura;
			    	$ca->curso_id = $r->curso;
			    	$ca->asignatura_id = $r->asignatura;
			    	$ca->jefe_curso = ($r->jefe == true)? 'S' : 'N';
			    	$ca->docente_id = $r->docente;
			    	$ca->activo = "S";
			    	$ca->horas_duracion = $r->horas;

			    	if ($ca->save()) {
			    		return "success";
			    	}
			    	return "failed";
	    }
    }
    public function listar_asignatura_en_curso($curso)
    {


    	return Cursoasignatura::select([
    			'u.nombres','u.apellido_materno','u.apellido_paterno',
    			'a.descripcion','curso-asignatura.jefe_curso','a.id as asignatura_id'
    	])
    	                      ->join('curso as c','c.id','curso-asignatura.curso_id')
    						  ->join('asignatura as a', 'a.id','curso-asignatura.asignatura_id')
    						  ->leftjoin('docente as d','d.id','curso-asignatura.docente_id')
    						  ->leftjoin('users as u','u.id','d.user_id')
    						  ->where('c.id', $curso)->get();

    }
    public function traer_inicio($curso)
    {
    	$docentejefe = Cursoasignatura::select([
    							'u.nombres','u.apellido_paterno','u.apellido_materno',
    							'd.id as docente_id'
    						])
    	  					  ->join('docente as d','d.id','curso-asignatura.docente_id')
    						  ->join('users as u','u.id','d.user_id')
    						  ->where([ 'curso-asignatura.curso_id'=> $curso, 'jefe_curso'=>'S' ])
    						  ->first();


    	return [
    		'docentejefe' => $docentejefe
    	];

    }

    public function contar_elementos()
    {
    	$curso = Curso::select('id')->where([
    		'promocion' => '2019',
    		'cuenta_id' => $this::_cuenta()->cuenta_id,
    		'activo' => 'S'
    	])->get();

    	$docente = Docente::select('docente.id')
    	                  ->join('docente-establecimiento as de','de.docente_id','docente.id')
    	                  ->where([
    	                  	'de.cuenta_id'=> $this::_cuenta()->cuenta_id,
    	                  	'de.activo' => 'S'
    	                  ])->get();

    	$alumno = Alumno::select('alumno.id')
    					->join('alumno-curso as ac','ac.alumno_id','alumno.id')
    					->join('curso as c','ac.curso_id','c.id')
    					->where([
    						'ac.anio_actual' => 'S',
    						'alumno.activo' => 'S',
    						'c.promocion' => '2019',
    						'c.activo' => 'S',
    						'c.cuenta_id' => $this::_cuenta()->cuenta_id
    					])
    					->get();

    	return [
    		'curso' => count($curso)>0 ? count($curso) : '0',
    		'docente' => count($docente)>0 ? count($docente) : '0',
    		'alumno' => count($alumno)>0 ? count($alumno) : '0'
    	];
    }

    public function obtener_perfil()
    {
       return cuentas::select([
                'cuentas.establecimiento',
                'cuentas.direccion',
                'cuentas.contacto',
                'cuentas.estado_cuenta',
                'cuentas.logo',
                'u.nombres',
                'u.apellido_paterno',
                'u.apellido_materno',
                'u.email',
                'r.descripcion'
        ])->join('cuentas_users as cu','cu.cuenta_id','cuentas.id')
                     ->join('users as u','u.id','cu.user_id')
                     ->join('rol as r','r.id','u.rol_id')
                     ->first();
    }

    public function actualizar_perfil(Request $r)
    {
        $c = Cuentas::find($this::_cuenta()->cuenta_id);
        $u = User::find(Auth::user()->id);

        switch ($r->nombre) {
            case 'establecimiento':
               $c->establecimiento = $r->establecimiento;
               if ($c->save()) {
                   return [
                        'tipo' => 'success',
                        'mensaje' => 'Establecimiento actualizado'
                   ];
               }

               return [
                        'tipo' => 'error',
                        'mensaje' => 'error al actualizar'
                   ];
            break;

            case 'contacto':
                $c->contacto = $r->contacto;
                if ($c->save()) {
                    return [
                        'tipo' => 'success',
                        'mensaje' => 'Contacto actualizado'
                    ];
                }

                return [
                        'tipo' => 'error',
                        'mensaje' => 'error al actualizar'
                   ];
            break;

            case 'direccion':
                $c->direccion = $r->direccion;
                if ($c->save()) {
                    return [
                        'tipo' => 'success',
                        'mensaje' => 'Dirección actualizado'
                    ];
                }
                return [
                        'tipo' => 'error',
                        'mensaje' => 'error al actualizar'
                   ];
            break;

            case 'email':
                $u->email = $r->email;
                if ($u->save()) {
                    return [
                        'tipo' => 'success',
                        'mensaje' => 'Email actualizado'
                    ];
                }
                return [
                        'tipo' => 'error',
                        'mensaje' => 'error al actualizar'
                   ];
            break;

            case 'password':

                if (Hash::check($r->actual_pass, $u->password)) {
                    
                    if ($r->new_pass === $r->repeat_pass) {
                        $u->password = bcrypt($r->new_pass);
                        if ($u->save()) {
                             return[
                                'tipo' => 'success',
                                'mensaje' => 'Password actualizada'
                            ];
                        }
                         return[
                            'tipo' => 'error',
                            'mensaje' => 'No fue posible actualizar la password'
                        ];
                    }
                     return[
                        'tipo' => 'error',
                        'mensaje' => 'las nuevas passwords no son iguales'
                    ];
                }else{
                    return[
                        'tipo' => 'error',
                        'mensaje' => 'Password incorrecta'
                    ];
                }
            
            default:
                # code...
                break;
        }

    }
    public function crear_asignatura(Request $r)
    {
        $a = new Asignatura;
        $a->descripcion = $r->asignatura;
        $a->observacion = $r->observacion;
        $a->activo = 'S';
        $a->cuenta_id = $this::_cuenta()->cuenta_id;
        if ($a->save()) {
            return [
                'tipo' => 'success',
                'mensaje'=>'Asignatura agregada'
            ];
        }
        return [
                'tipo' => 'error',
                'mensaje'=>'Error al registrar'
            ];
    }
}
