<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MessageSentEvent;
use App\Notificachat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function fetch($id)
    {
        return Chat::getMensajes($id);
    }

    public function sentMessage(Request $request)
    {
        $user = Auth::user();
        $cod ='';
        $message = new Chat;
          $message->id_user_envia = Auth::user()->id;
		  $message->id_user_recibe = $request->id_recibe;
		  $message->mensaje = $request->message;
		  $message->activo = "S";
		  if($message->save()){

              // $verify = Notificachat::where('codigo_chat', $cod)->first();
	                $verify = Notificachat::where([
	                    'user_envia'=> Auth::user()->id,
	                    'user_recibe'=> $request->id_recibe
	                ])->orWhere('user_envia','=',$request->id_recibe)
	                ->where('user_recibe','=', Auth::user()->id)
	                ->first();

                // return $verify;

	                if ($verify) {

	                	$now = DB::select('select NOW()');
	                	//dd($now[0]->now);

	                    $verify->id_chat = $message->id;
	                    $verify->user_envia = Auth::user()->id;
                    	$verify->user_recibe = $request->id_recibe;
	                    $verify->visto = "N";
	                    //$verify->updated_at = $now[0]->now;
	                    $verify->save();

	                    
	                }else{
	                	return "aqui 2";
	                    $nch = new Notificachat;
	                    $nch->user_envia = Auth::user()->id;
	                    $nch->user_recibe = $request->id_recibe;
	                    $nch->id_chat = $message->id;
	                    $nch->activo = "S";
	                    $nch->visto = "N";
	                    $nch->save();
	                    
	                }


                broadcast(new MessageSentEvent($user, $message))->toOthers();
                return "true";
                    
          }
    }
     public function sendFoto(Request $dato){
        //dd($dato->file('fotos'));
         $user = Auth::user();
        if($files=$dato->file('fotos')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('storage/chatfotos',$name);

                $message = new Chat;
                $message->id_user_envia = Auth::user()->id;
                $message->id_user_recibe = $dato->id_recibe;
                $message->mensaje = $dato->newMessage;
                $message->archivo = 'storage/chatfotos/'.$name;
                $message->activo = "S";

                if($message->save()){
                    broadcast(new MessageSentEvent($user, $message))->toOthers();
                    return "true";

                }
                return "false";

            }
        }
    }
}
