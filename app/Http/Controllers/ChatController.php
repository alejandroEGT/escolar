<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MessageSentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
	                // $verify = Notificachat::where([
	                //     'user_envia'=> Auth::user()->id,
	                //     'user_recibe'=> $request->id_recibe
	                // ])->orWhere('user_envia','=',$request->id_recibe)
	                // ->where('user_recibe','=', Auth::user()->id)->first();

                //return $verify;

	                // if ($verify) {
	                //     $verify->id_chat = $message->id;
	                //     $verify->save();
	                // }else{
	                //     $nch = new Notificachat;
	                //     $nch->user_envia = Auth::user()->id;
	                //     $nch->user_recibe = $request->id_recibe;
	                //     $nch->id_chat = $message->id;
	                //     $nch->save();
	                // }


                broadcast(new MessageSentEvent($user, $message))->toOthers();
                return "true";
                    
          }
    }
}
