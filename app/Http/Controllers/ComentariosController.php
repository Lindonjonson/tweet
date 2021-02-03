<?php

namespace App\Http\Controllers;

use App\Models\comentarios;
use App\Models\Tweet;
use App\Models\User;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function store(Request $request){
        $Tweet = Tweet::get();
        $Comentario = comentarios::get();
    
        $tt =  comentarios::create([
            'comentario' => $request->field_2,  
            'id_usuario' => auth()->user()->id,
            'id_tweet' => $request->Post
        ]); 
        return redirect()->route('index');



    }
}
