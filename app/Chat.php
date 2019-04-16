<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    protected $table="chat";


     protected function getMensajes($id_otro)
    {
    	$id = Auth::user()->id;
    	return DB::select("SELECT DISTINCT ch.mensaje, ch.archivo,ch.id_user_envia, ch.id_user_recibe, ch.created_at,
			(select us.nombres from users as us where us.id = ".$id.") as use_1, 
			(select us.avatar from users as us where us.id = ".$id.") as foto_use_1, 
			(select us.nombres from users as us where us.id = ".$id_otro.") as use_2,
			(select us.avatar from users as us where us.id = ".$id_otro.") as foto_use_2

	FROM users as us inner join chat as ch on ch.id_user_envia = us.id or ch.id_user_recibe = us.id where (ch.id_user_recibe = ".$id." or ch.id_user_envia= ".$id.") and (ch.id_user_recibe = ".$id_otro." or ch.id_user_envia= ".$id_otro.") order by ch.created_at ASC");
    }
}
