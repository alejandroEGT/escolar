<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alumnocalificacion extends Model
{
	protected $table="alumno-calificacion";

    protected function traer_notas($curso, $asignatura, $seccion, $docente)
    {

		
    	$alumnos = Alumno::select([
    					'alumno.id',
    					'alumno.nombre',
    					'alumno.apellido_paterno',
    					'alumno.apellido_materno',
    					'ca.curso_id','ca.asignatura_id'
    				])
    	           ->join('alumno-curso as ac', 'ac.alumno_id','alumno.id')
    			   ->join('curso-asignatura as ca','ca.curso_id','ac.curso_id')	
    	           ->where([
    	           		'ca.docente_id' => $docente,
    	           		'ca.curso_id' => $curso, 'ca.asignatura_id' => $asignatura, 'ac.activo' => 'S'
    	           ])
    	           ->orderBy('alumno.apellido_paterno')
    	           ->get();


    	 $calificaciones = Alumnocalificacion::where([
    	 						'curso_id' => $curso, 'asignatura_id' => $asignatura, 'seccion'=> $seccion,'activo' => 'S'
    	 					])->get();

    	 //return $calificaciones;

    	foreach ($alumnos as $solo_lista) {
					    $solo_lista->seccion = null;
						$solo_lista->nota1= null;
						$solo_lista->nota2= null;
						$solo_lista->nota3= null;
						$solo_lista->nota4= null;
						$solo_lista->nota5= null;
						$solo_lista->nota6= null;
						$solo_lista->nota7= null;
						$solo_lista->nota8= null;
						$solo_lista->nota9= null;
						$solo_lista->nota10= null;

				foreach ($calificaciones as $existe) {
					$arr_total = [];
					if ($solo_lista->id == $existe->alumno_id) {
						$solo_lista->seccion = $existe->seccion;
						$solo_lista->nota1= $existe->nota1;
						$solo_lista->nota2= $existe->nota2;
						$solo_lista->nota3= $existe->nota3;
						$solo_lista->nota4= $existe->nota4;
						$solo_lista->nota5= $existe->nota5;
						$solo_lista->nota6= $existe->nota6;
						$solo_lista->nota7= $existe->nota7;
						$solo_lista->nota8= $existe->nota8;
						$solo_lista->nota9= $existe->nota9;
						$solo_lista->nota10= $existe->nota10;

						$arr_total = [
							$solo_lista->nota1,
							$solo_lista->nota2,
							$solo_lista->nota3,
							$solo_lista->nota4,
							$solo_lista->nota5,
							$solo_lista->nota6,
							$solo_lista->nota7,
							$solo_lista->nota8,
							$solo_lista->nota9,
							$solo_lista->nota10

						];

						$filtro_total = array_filter($arr_total);
						$cantidad_total = count($filtro_total);
						//return ($cantidad_total);
						$solo_lista->total = $cantidad_total==0?null:number_format((array_sum($filtro_total) / $cantidad_total),2);
					}
				}
				
			}


			


			return $alumnos;

    }

    protected function registrar_nota($r)
    {
    	 // dd($r);
    	$existe = Alumnocalificacion::where([ 'alumno_id' => $r->alumno,
    	 						'curso_id' => $r->curso, 'asignatura_id' => $r->asignatura, 'seccion'=> $r->seccion,'activo' => 'S'
    	 					])->first();
    	
    	if ($existe == true) {
    		 switch ($r->nota_nombre) {
    		 	case 'n1':
    		 		$existe->nota1 = $r->nota_valor;
    		 	break;
    		 	case 'n2':
    		 		$existe->nota2 = $r->nota_valor;
    		 	break;
    		 	case 'n3':
    		 		$existe->nota3 = $r->nota_valor;
    		 	break;
    		 	case 'n4':
    		 		$existe->nota4 = $r->nota_valor;
    		 	break;
    		 	case 'n5':
    		 		$existe->nota5 = $r->nota_valor;
    		 	break;
    		 	case 'n6':
    		 		$existe->nota6 = $r->nota_valor;
    		 	break;
    		 	case 'n7':
    		 		$existe->nota7 = $r->nota_valor;
    		 	break;
    		 	case 'n8':
    		 		$existe->nota8 = $r->nota_valor;
    		 	break;
    		 	case 'n9':
    		 		$existe->nota9 = $r->nota_valor;
    		 	break;
    		 	case 'n10':
    		 		$existe->nota10 = $r->nota_valor;
    		 	break;
    		 	
    		 	default:
    		 		# code...
    		 		break;
    		 }
    		 if($existe->save()){
    		 	return[
    		 		'tipo'=>'success', 'mensaje'=>'Nota Ingresada'
    		 	];
    		 }
    	}else{
    		$ac = new Alumnocalificacion;
    		$ac->alumno_id = $r->alumno;
    		$ac->asignatura_id = $r->asignatura;
    		$ac->curso_id = $r->curso;
    		$ac->activo = 'S';
    		$ac->seccion = $r->seccion;

    		switch ($r->nota_nombre) {

    		 	case 'n1':
    		 		$ac->nota1 = $r->nota_valor;
    		 	break;
    		 	case 'n2':
    		 		$ac->nota2 = $r->nota_valor;
    		 	break;
    		 	case 'n3':
    		 		$ac->nota3 = $r->nota_valor;
    		 	break;
    		 	case 'n4':
    		 		$ac->nota4 = $r->nota_valor;
    		 	break;
    		 	case 'n5':
    		 		$ac->nota5 = $r->nota_valor;
    		 	break;
    		 	case 'n6':
    		 		$ac->nota6 = $r->nota_valor;
    		 	break;
    		 	case 'n7':
    		 		$ac->nota7 = $r->nota_valor;
    		 	break;
    		 	case 'n8':
    		 		$ac->nota8 = $r->nota_valor;
    		 	break;
    		 	case 'n9':
    		 		$ac->nota9 = $r->nota_valor;
    		 	break;
    		 	case 'n10':
    		 		$ac->nota10 = $r->nota_valor;
    		 	break;
    		 	
    		 	default:
    		 		# code...
    		 		break;
    		 }
    		  if($ac->save()){
    		 	return[
    		 		'tipo'=>'success', 'mensaje'=>'Nota Ingresada'
    		 	];
    		 }
    		
    	}
    }
}
