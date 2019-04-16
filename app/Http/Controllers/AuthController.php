<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

	public function aleatorio_colors(){
        $array =  Array('#F5B041','#EC7063','#B2BABB','#45B39D','#BB8FCE','#3498DB','#5D6D7E');
        $rand = random_int ( 0 , 6 );
        return $array[$rand];
    } 
    public function register(RegisterFormRequest $request)
	{
		$nombre_letra = substr($request->nombre,0,1);
		$avatar = new Avatar;
        $uriAvatar = 'storage/user_avatar/'.time().'.png';
       // $urlBack = 'background/'.time().'-'.$request->email.'.png';
        $avatar->create(strtoupper($nombre_letra))->setBackground($this->aleatorio_colors())->save($uriAvatar, $quality = 90);

	    $user = new User;
	    $user->email = $request->email;
	    $user->nombres = $request->nombre;
	    $user->apellido_paterno = $request->apellido_p;
	    $user->apellido_materno = $request->apellido_m;
	    $user->rol_id = $request->rol;
	    $user->sexo = $request->sexo;
	    $user->password = bcrypt($request->password);
	    $user->avatar =  $uriAvatar;
	    $user->save();
	    return response([
	        'status' => 'success',
	        'data' => $user
	       ], 200);
	 }

	public function login(Request $request)
	{
	    $credentials = $request->only('email', 'password');
	    if ( ! $token = JWTAuth::attempt($credentials)) {
	            return response([
	                'status' => 'error',
	                'error' => 'invalid.credentials',
	                'msg' => 'Invalid Credentials.'
	            ], 400);
	    }
	    return response([
	            'status' => 'success'
	        ])
	        ->header('Authorization', $token);
	}

	public function user(Request $request)
	{
	    $user = User::find(Auth::user()->id);
	    return response([
	            'status' => 'success',
	            'data' => $user
	        ]);
	}
	public function refresh()
	{
	    return response([
	            'status' => 'success'
	        ]);
	}

	public function logout()
	{
	    JWTAuth::invalidate();
	    return response([
	            'status' => 'success',
	            'msg' => 'Logged out Successfully.'
	        ], 200);
	}
	public function valida_rol($correo)
	{
		$user = User::where('email', $correo)->first();
		return $user->rol_id;
	}
}
