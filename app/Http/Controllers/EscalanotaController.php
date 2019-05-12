<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscalanotaController extends Controller
{
    public function registrar(Request $r)
    {	$n = [];

    	for ($i=$r->puntaje_minimo; $i <= $r->puntaje_maximo; $i++) { 
    			//echo 'Pts: '.$r->puntaje_minimo.': '. $r->minima.'<br>';
    		$n[$i]['puntaje'] = $i;

    		if($r->puntaje_minimo < (($r->exigencia/100) * $r->puntaje_maximo)){
    		 	$n[$i]['nota'] = round(($r->aprovacion - $r->minima) *  ($r->puntaje_minimo == 0? 0 : $r->puntaje_minimo / (($r->exigencia/100) * $r->puntaje_maximo) ) + $r->minima);
    		}
    		if($r->puntaje_minimo >= (($r->exigencia/100) * $r->puntaje_maximo)){
    			//return sprintf("%.f",  );
    			//return number_format( (float) $r->puntaje_minimo, 2, '.', '');
				$n[$i]['nota'] =round(($r->maxima - $r->aprovacion) * ( ($r->puntaje_minimo - (($r->exigencia/100) * $r->puntaje_maximo))  /  ($r->puntaje_maximo * (1 - ($r->exigencia/100)) ) ) + $r->aprovacion );
    		}

    		// $r->minima++;
    		if ($r->puntaje_minimo < $r->puntaje_maximo) {
    		
    			$r->puntaje_minimo++;
    		}
    	}

    	return json_encode($n);
    }
}

//((70 - 40) * (60 - ((60/100) * 120)) / (120 * (100-60)) + 40)