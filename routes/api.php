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
  Route::get('auth/admin/validar_pass/{pass}','AdminCuentaController@validar_pass');
  Route::get('auth/admin/listar_permisos','AdminCuentaController@listar_permisos');
  Route::post('auth/admin/agregar_permiso','AdminCuentaController@agregar_permiso');
  Route::get('auth/admin/listar_permisos_user','AdminCuentaController@listar_permisos_user');
  Route::post('auth/admin/crearapoderado','AdminCuentaController@crearapoderado');
  Route::get('auth/admin/listar_apoderado/{alumno}/{curso}','AdminCuentaController@listar_apoderado');
  Route::post('auth/admin/crear_comportamiento','AdminCuentaController@crear_comportamiento');
  Route::get('auth/admin/ver_comportamiento','AdminCuentaController@ver_comportamiento');
  Route::get('auth/admin/grafico_genero/{anio}/{curso}','AdminCuentaController@grafico_genero');

  Route::get('kkck', function(){
      
      return response()->json([ 
          'categories'=>['aa','bb','cc','dd','ee'],
          'data' => [100, 200, 300, 400, 500, 600, 700, 800]
        
         ]);

  });







 //DOCENTE DEL COLEGIO///////////////////////
  Route::get('auth/docente/profesor_jefe','DocenteController@profesor_jefe');
  Route::get('auth/docente/mis_cursos','DocenteController@mis_cursos');
  Route::get('auth/docente/datos_basicos/{curso}/{asignatura}','DocenteController@datos_basicos');
  Route::get('auth/docente/libro_nota/{curso}/{asignatura}/{seccion}','DocenteController@libro_notas');
  Route::post('auth/docente/registrar_nota','DocenteController@registrar_nota');
  Route::post('auth/docente/registrar_actividad','DocenteController@registrar_actividad');
  Route::get('auth/docente/listar_actividad/{curso}/{asignatura}','DocenteController@listar_actividad');
  Route::get('auth/docente/listar_docentes','DocenteController@listar_docentes_colegio');
  Route::get('auth/docente/listar_alumno_jcurso/{curso}','DocenteController@listar_alumnos_jcurso');
    
  Route::get('auth/docente/exportar_nota_por_asignatura/{curso}/{asignatura}/{seccion}', 'ExcelController@exportar_nota_por_asignatura');

  Route::get('auth/docente/actividad_general','DocenteController@actividad_general');
  Route::get('auth/docente/activiar_record/{record}','DocenteController@activiar_record');
  Route::get('auth/docente/desactiviar_record/{record}','DocenteController@desactiviar_record');
  Route::get('auth/docente/listar_alumnos_y_apoderados/{curso}/{asignatura}','DocenteController@listar_ap_y_doc');
  Route::get('auth/docente/ver_comportamiento/{alumno}/{curso}/{seccion}','DocenteController@ver_comportamiento');
  Route::post('auth/docente/asignar_comportamiento','DocenteController@asignar_comportamiento');
  Route::get('auth/docente/ver_notas_prof_jefe/{alumno}/{curso}/{seccion}','DocenteController@ver_notas_prof_jefe');

  
  // listar_docentes_colegio
  //mis_cursos

  Route::get('auth/messages/{id}', 'ChatController@fetch');
  Route::post('auth/messages', 'ChatController@sentMessage');
  Route::post('auth/fotoChat','ChatController@sendFoto');

});

Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});