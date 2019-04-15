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



//ADMIN DEL COLEGIO//////////////////////////
  Route::get('auth/sa/logo','CuentaController@logo');
  Route::post('auth/admin/creacurso','AdminCuentaController@crear_curso');
  Route::get('auth/admin/listarcurso','AdminCuentaController@listar_curso');
  Route::post('auth/admin/creardocente','AdminCuentaController@crearDocente');
  Route::get('auth/admin/obtener_docentes','AdminCuentaController@obtener_docentes');
  Route::get('auth/admin/obtener_curso','AdminCuentaController@obtener_cursos');
  Route::post('auth/admin/crearalumno','AdminCuentaController@crearAlumno');
  Route::get('auth/admin/listaralumno','AdminCuentaController@obtener_alumnos');
  Route::get('auth/admin/listaralumno_filter/{curso}','AdminCuentaController@obtener_alumnos_filter');
  Route::get('auth/admin/perfil_curso/{curso}','AdminCuentaController@perfil_curso');
  Route::get('auth/admin/obtener_asignaturas','AdminCuentaController@obtener_asignaturas');
  Route::post('auth/admin/agregarasignatura','AdminCuentaController@agregarasignatura');
  Route::get('auth/admin/listar_asignatura_en_curso/{curso}','AdminCuentaController@listar_asignatura_en_curso');
  Route::get('auth/admin/traer_inicio/{docente}','AdminCuentaController@traer_inicio');
  Route::get('auth/admin/contar_elementos','AdminCuentaController@contar_elementos');
  Route::get('auth/admin/obtener_perfil','AdminCuentaController@obtener_perfil');
  Route::post('auth/admin/actualizar_perfil','AdminCuentaController@actualizar_perfil');
  Route::post('auth/admin/crear_asignatura','AdminCuentaController@crear_asignatura');

 








 //DOCENTE DEL COLEGIO///////////////////////
  Route::get('auth/docente/profesor_jefe','DocenteController@profesor_jefe');
  Route::get('auth/docente/mis_cursos','DocenteController@mis_cursos');
  Route::get('auth/docente/datos_basicos/{curso}/{asignatura}','DocenteController@datos_basicos');
  Route::get('auth/docente/libro_nota/{curso}/{asignatura}/{seccion}','DocenteController@libro_notas');
  Route::post('auth/docente/registrar_nota','DocenteController@registrar_nota');
  Route::post('auth/docente/registrar_actividad','DocenteController@registrar_actividad');
  Route::get('auth/docente/listar_actividad/{curso}/{asignatura}','DocenteController@listar_actividad');
  //mis_cursos

});

Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});