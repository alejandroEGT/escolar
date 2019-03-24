<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([

        	[
        		'id'=>'1',
        		'descripcion'=>'Super Administrador',
        		'activo'=>'S'
        	],
        	[
        		'id'=>'2',
        		'descripcion'=>'Administrador',
        		'activo'=>'S'
        	],
        	[
        		'id'=>'3',
        		'descripcion'=>'Docente',
        		'activo'=>'S'
        	]
        ]);
    }
}
