<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alumno_curso extends Model
{
    protected $table ="alumno-curso";


    protected function admin_obtener_alumnos($cuenta_id, $curso='')
    {

		if ($curso == '') {


			$query = Alumno::leftjoin('alumno-curso as ac','ac.alumno_id','alumno.id')
						   ->leftjoin('curso as c','c.id','ac.curso_id')
						   ->where('c.cuenta_id', $cuenta_id)->get();

			return $query;
		}
		if ($curso != '') {
			// $query = DB::select('SELECT * FROM alumno as a 
			// LEFT join alumno-curso as ac on ac.alumno_id = a.id
			// LEFT join curso as cu on cu.id = ac.curso_id
			// WHERE cu.cuenta_id = ?  and ac.curso_id = ?', [ $cuenta_id, $curso ]);

			$query = Alumno::leftjoin('alumno-curso as ac','ac.alumno_id','alumno.id')
						   ->leftjoin('curso as c','c.id','ac.curso_id')
						   ->where([
						   	'c.cuenta_id'=> $cuenta_id,
						   	'ac.curso_id'=> $curso
						   ])->get();

			return $query;
		}

    }

    protected function docente_obtener_alumnos($cuenta_id, $curso='', $docente)
    {

		if ($curso == '') {


			$query = Alumno::leftjoin('alumno-curso as ac','ac.alumno_id','alumno.id')
						   ->leftjoin('curso as c','c.id','ac.curso_id')
						   ->where('c.cuenta_id', $cuenta_id)->get();

			return $query;
		}
		if ($curso != '') {

			$query = Alumno::leftjoin('alumno-curso as ac','ac.alumno_id','alumno.id')
						   ->leftjoin('curso as c','c.id','ac.curso_id')
						   ->leftjoin('curso-asignatura as ca','ca.curso_id','c.id')
						   ->where([
						   	'ca.activo' => 'S',
						   	'ca.jefe_curso' => 'S',
						   	'ca.docente_id' => $docente,
						   	'c.cuenta_id'=> $cuenta_id,
						   	'ac.curso_id'=> $curso
						   ])->get();

			return $query;
		}

    }
}
