<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('auth/register', 'AuthController@register');

Route::post('auth/login', 'AuthController@login');
Route::get('auth/valida_rol/{correo}','AuthController@valida_rol');

Route::group(['middleware' => 'jwt.auth'], function(){

  Route::get('auth/user', 'AuthController@user');
  Route::post('auth/logout', 'AuthController@logout');


//SUPERADMINISTRADOR
  Route::post('auth/sa/crearcuenta','CuentaController@crearCuenta');
  Route::post('auth/sa/creardocente','CuentaController@crearDocente');
  Route::get('auth/sa/obtener_docentes','CuentaController@obtener_docentes');
  Route::get('auth/sa/obtener_cuentas','CuentaController@obtener_cuentas');



//ADMIN DEL COLEGIO///////////////////////////
  Route::get('auth/sa/logo','CuentaController@logo');
  Route::post('auth/admin/creacurso','AdminCuentaController@crear_curso');
  Route::get('auth/admin/listarcurso','AdminCuentaController@listar_curso');

});

Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});