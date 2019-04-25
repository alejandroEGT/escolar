<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Alumno_curso;
use App\Alumnoapoderado;
use App\Asignatura;
use App\Curso;
use App\Cursoasignatura;
use App\Docente;
use App\Permiso;
use App\User;
use App\Userpermiso;
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
        $curso->nivel_educativo = $r->nivel;
    	if ($curso->save()) {
    		return "success";
    	}
    }

    public function listar_curso()
    {
    	return Curso::where('cuenta_id', $this::_cuenta()->cuenta_id)
        ->where('activo', 'S')
        ->get();
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
        $array =  Array('#F5B041','#EC7063','#B2BABB','#45B39D','#BB8FCE','#3498DB','#5D6D7E', '#DC7633','#17A589',
                        '#5499C7','#28B463'
                        );
        $rand = random_int ( 0 , 10 );
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
    	           ->where('de.cuenta_id', $this::_cuenta()->cuenta_id)
                   ->where('d.activo','S')
                   ->get();
    	      
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
    	return Asignatura::where([
            'cuenta_id' => $this::_cuenta()->cuenta_id,
            'activo' => 'S'
        ])->get();
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

    public function validar_pass($pass)
    {
        $db = User::find(Auth::user()->id);

        if(Hash::check($pass, $db->password)) {
            return "1";
        }else{
            return "0";
        }
    }
    public function listar_permisos()
    {
        return DB::table('permisos')->get();
    }
    public function agregar_permiso(Request $r)
    {

            $cantidad_permisos = count($r->permiso);
            $save = 0;
            $error =0;
            $repeat =0;
            $retornar =[];
            foreach ($r->permiso as $key) {

                $verify = Userpermiso::where([
                        'user_id' => $r->usuario,
                        'permiso_id' => $key,
                        'activo' => 'S'
                ])->first();
                //dd(empty($verify));

                if (empty($verify)) {
                    $up = new Userpermiso;
                    $up->user_id = $r->usuario;
                    $up->permiso_id = $key;
                    $up->activo = 'S';
                    $up->cuenta_id = $this::_cuenta()->cuenta_id;
                    if($up->save()){
                        //return ['tipo'=>'success','mensaje'=>'Acceso asignado'];
                        $save++;
                    }else{
                        $error++;
                        //return ['tipo'=>'error','mensaje'=>'Error, no es posible asignar'];
                    }
                }else{
                    $repeat++;
                    //$retornar[0] = ['tipo'=>'repeat','mensaje'=>'Existen permisos ya asignados'];
                }  
            }
            if ($save > 0 and $repeat > 0) {
                return ['tipo'=>'success','mensaje'=>'Acceso asignado, pero ya existen algunos accesos en este usuario'];
            }
            if ($repeat > 0 and $save == 0) {
                return ['tipo'=>'error','mensaje'=>'ya existen algunos accesos en este usuario'];
            }
            if ($error > 0) {
                return ['tipo'=>'error','mensaje'=>'Error, no es posible asignar'];
            }
            if ($save > 0) {
                return ['tipo'=>'success','mensaje'=>'Acceso asignado'];
            }
            
    }
    public function listar_permisos_user()
    {
        return Userpermiso::select([
                'u.nombres', 'u.apellido_materno','u.apellido_paterno','u.email',
                'p.descripcion', 'user_permiso.activo'
        ])->join('users as u','u.id','user_permiso.user_id')
                          ->join('permisos as p','user_permiso.permiso_id','p.id')
                            ->where([
                                'user_permiso.cuenta_id' => $this::_cuenta()->cuenta_id,
                                'user_permiso.activo' => 'S',
                                //'u.activo' => 'S',

                            ])
                            ->get();
    }

    public function crearapoderado(Request $r)
    {

        $avatar = new Avatar;

        $uriAvatar = 'storage/user_avatar/'.time().'.png';
       // $urlBack = 'background/'.time().'-'.$request->email.'.png';
        $nombre_letra = substr($r->nombres,0,1);
        $avatar->create(strtoupper($nombre_letra))->setBackground($this->aleatorio_colors())->save($uriAvatar, $quality = 90);
        $ap = new User;
        $aa = new Alumnoapoderado;
        $ap->nombres = $r->nombres;
        $ap->apellido_paterno = $r->apellido_p;
        $ap->apellido_materno = $r->apellido_m;
        $ap->email = $r->email;
        $ap->password = bcrypt('123456');
        $ap->rol_id = 20;
        $ap->sexo ='I';
        $ap->avatar = $uriAvatar;
        if ($ap->save()) {
           $aa->alumno_id = $r->alumno;
           $aa->user_id = $ap->id;
           $aa->activo = "S";
           if ($aa->save()) {
               return [
                'tipo'=>'success',
                'mensaje' => 'Apoderado ingresado'
            ];
           }
           return [
                'tipo'=>'error',
                'mensaje' => 'Error al ingresar'
            ];
        }
         return [
                'tipo'=>'error',
                'mensaje' => 'Error al ingresar'
            ];
    }
    public function listar_apoderado($alumno, $curso)
    {
        return User::join('alumno_apoderado as aa','aa.user_id','users.id')
                   ->join('alumno as a','a.id','aa.alumno_id')
                   ->join('alumno-curso as ac','ac.alumno_id','a.id')
                   ->where([
                        'ac.curso_id' => $curso,
                        'aa.alumno_id' => $alumno
                   ])
                   ->get();
    }
}
