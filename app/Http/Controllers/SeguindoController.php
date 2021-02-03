<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguindoController extends Controller
{
    public function seguindo(){

    $Seguindos = DB::table('seguindos')
    ->select('seguindos.id','seguindos.id_usuario','users.id,users.name','tweets.conteudo')
    ->join('users','users.id', '=' ,'seguindos.id_usuario_seguindo')
    ->join('users','users.id', '=' ,'seguindos.id_usuario_seguindo')
    ->where('seguindos.id_usuario', auth()->user()->id)
    ->orderBy('tweets.created_at','DESC')
    ->get();

    }
}
