<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificachat extends Model
{
    protected $table="notifica_chat";

    protected $touches = ['updated_at'];

    public function updated_at()
    {
        return $this->belongsTo('App\Notificachat');
    }
}
