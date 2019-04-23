<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Alumnocalificacion;
use App\Asignatura;
use App\Curso;
use App\Docente;
use App\ExampleSerialiser;
use Exporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Exporter;

class ExcelController extends Controller
{
	// use Exporter;
    public function exportar_nota_por_asignatura($curso, $asignatura, $seccion)
    {
    	//dd("$curso, $asignatura");
    	$c = Curso::find($curso);
    	$a = Asignatura::find($asignatura);
    	$docente = Docente::where('user_id', Auth::user()->id)->first();
    	$json = Alumnocalificacion::traer_notas($curso, $asignatura, $seccion, $docente->id);
    	//dd($json);
  //   	$excel = Exporter::make('Excel');
		// $excel->setSerialiser(new ExampleSerialiser)->load($json);
		// return $excel->stream('alumnos.xlsx');
		$collection = Exporter::make('Excel')
		              ->load($json)
		              ->setSerialiser(new ExampleSerialiser)

		              ->stream($c->descripcion.'_'.$a->descripcion.'.xlsx');
    }
}
