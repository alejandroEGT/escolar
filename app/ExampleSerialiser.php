<?php  


namespace App;

use Illuminate\Database\Eloquent\Model;
use Cyberduck\LaravelExcel\Contract\SerialiserInterface;

class ExampleSerialiser implements SerialiserInterface
{
    public function getData($data)
    {
        $row = [];

        //$row[] = $data->id;
        $row[] = $data->nombre;
        $row[] = $data->apellido_paterno;
        $row[] = $data->apellido_materno;
       // $row[] = $data->curso_id;
       // $row[] = $data->asignatura_id;
       // $row[] = $data->seccion;
        $row[] = $data->nota1;
        $row[] = $data->nota2;
        $row[] = $data->nota3;
        $row[] = $data->nota4;
        $row[] = $data->nota5;
        $row[] = $data->nota6;
        $row[] = $data->nota7;
        $row[] = $data->nota8;
        $row[] = $data->nota9;
        $row[] = $data->nota10;
        $row[] = $data->total;

        return $row;
    }

    public function getHeaderRow()
    {
        return [
           // 'ID',
            'NOMBRES',
            'APELLIDO_P',
            'APELLIDO_M',
           // 'CURSO_ID',
           // 'ASIGNATURA_ID',
           // 'SECCION',
            'NOTA1',
            'NOTA2',
            'NOTA3',
            'NOTA4',
            'NOTA5',
            'NOTA6',
            'NOTA7',
            'NOTA8',
            'NOTA9',
            'NOTA10',
            'PROMEDIO'
            
        ];
    }
}