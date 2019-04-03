<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Alumno_curso;
use App\Curso;
use App\Docente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function crearDocente(Request $r)
    {

    	$user = new User;
    	$user->nombres = $r->nombre;
    	$user->apellido_paterno = $r->apellido_p;
    	$user->apellido_materno = $r->apellido_m;
    	$user->email = $r->email;
    	$user->rol_id = '3';
    	$user->sexo = $r->sexo;
    	$user->password = bcrypt($r->password);

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
}
