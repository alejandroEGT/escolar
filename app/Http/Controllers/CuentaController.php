<?php

namespace App\Http\Controllers;

use App\Docente;
use App\User;
use App\cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Avatar;

class CuentaController extends Controller
{
	public function aleatorio_colors(){
        $array =  Array('#F5B041','#EC7063','#B2BABB','#45B39D','#BB8FCE','#3498DB','#5D6D7E');
        $rand = random_int ( 0 , 6 );
        return $array[$rand];
    } 
    public function crearCuenta(Request $r)
    {

		$avatar = new Avatar;
        $uriAvatar = 'storage/'.time().'.png';
       // $urlBack = 'background/'.time().'-'.$request->email.'.png';
        $avatar->create(strtoupper($r->establecimiento))->setBackground($this->aleatorio_colors())->save($uriAvatar, $quality = 90);

       
		
    	$cuenta = new cuentas;
    	$cuenta->establecimiento = $r->establecimiento;
    	$cuenta->direccion = $r->direccion;
    	$cuenta->contacto = $r->contacto;
    	$cuenta->estado_cuenta = "S";
    	$cuenta->logo = $uriAvatar;;

    	if ($cuenta->save()) {
    		$usuario = new User;
    		$usuario->nombres = $r->nombre;
    		$usuario->apellido_paterno = $r->apellido_p;
    		$usuario->apellido_materno = $r->apellido_m;
    		$usuario->email = $r->email;
    		$usuario->password= bcrypt($r->password);
    		$usuario->rol_id="2";
    		$usuario->sexo= $r->sexo;

    		if ($usuario->save()) {
    			$media = DB::table('cuentas_users')->insert([
    				'user_id'=> $usuario->id,
    				'cuenta_id' => $cuenta->id,
    				'activo' => 'S'
    			]);

    			if ($media) {
    				return "success";
    			}
    		}
    	
    	}
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
    			return "success";
    		}
    	}
    }

    public function logo()
    {
    	$logo = DB::table('cuentas')->select(['logo','establecimiento'])
    			->join('cuentas_users as cu','cu.cuenta_id','cuentas.id')
    			->where('cu.user_id', Auth::user()->id)->first();
    	return [
    		'logo' => $logo->logo,
    		'establecimiento' => $logo->establecimiento
    	];
    }
    public function obtener_docentes()
    {
    	return User::join('docente as d','d.user_id','users.id')->get();
    	      
    }
    public function obtener_cuentas()
    {
    	return DB::table('cuentas as c')
    	          ->join('cuentas_users as cu', 'c.id','cu.cuenta_id')
    	          ->join('users as u', 'u.id','cu.user_id')->get();
    }
}

