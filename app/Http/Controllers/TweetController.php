<?php

namespace App\Http\Controllers;

use App\Models\Seguindo;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    public function index(){
        $Tweet = Tweet::get();
        $User = User::get();

        $VerificaSeguir = DB::table('seguindos')
           ->where('id_usuario', auth()->user()->id)
           ->where( 'id_usuario_seguindo' , auth()->user()->id )
            ->get();
           
            if(count($VerificaSeguir) == 0){
              $Ver =  Seguindo::create([
                    'id_usuario' => auth()->user()->id, 
                    'id_usuario_seguindo' => auth()->user()->id
                ]);  
            }


        $Posts = DB::table('tweets')
        ->join('users','users.id', '=' ,'tweets.id_usuario')
        ->select('users.name','tweets.conteudo','tweets.created_at','tweets.id')
        ->orderByRaw('created_at DESC')
        ->get();


        //**campo de sujetões de seguidores */
        $sujetoes = DB::table('seguindos')
        ->select('id_usuario', 'id_usuario_seguindo')
        ->get();

        $jaSeguindo =DB::table('seguindos')
        ->select('id_usuario_seguindo')
        ->where('id_usuario', auth()->user()->id)
        ->orWhere('id_usuario_seguindo', auth()->user()->id)
        ->get();

            //dd($jaSeguindo);
        $Seguindo = DB::table('seguindos')
        ->select('seguindos.id_usuario','seguindos.id_usuario_seguindo', 'users.name','tweets.id', 'tweets.conteudo', 'tweets.id_usuario')
        ->join('tweets','tweets.id_usuario', '=' ,'seguindos.id_usuario_seguindo')
        ->join('users','users.id', '=' ,'seguindos.id_usuario_seguindo')
        ->where('seguindos.id_usuario', auth()->user()->id)
        ->orderBy('tweets.created_at','DESC')
        ->get();

           // dd($Seguindo);

        $MeuPosts = DB::table('tweets')
        ->join('users','users.id', '=' ,'tweets.id_usuario')
        ->select('users.name','tweets.conteudo','tweets.created_at','tweets.id')
        ->where('users.id', auth()->user()->id)
        ->orderByRaw('created_at DESC')
        ->get();
        //dd($MeuPosts);

        
       $contaQtdPost = count($Posts);
       //dd($contaQtdPost);
        //*****Gerenciando comentarios 

        $comentarios = DB::table('comentarios')
        ->join('users','users.id', '=' ,'comentarios.id_usuario')
        ->join('tweets','tweets.id', '=' ,'comentarios.id_tweet')
        ->select('users.name','tweets.id','comentarios.comentario')
        ->orderBy('comentarios.created_at','asc')
        ->get();


        $contaComentarioTotal = count($comentarios);
        //dd($contaComentarioTotal);

       // dd($comentarios)
        //sugestão
        



        return view('tt.publicacoes', [
            'contaQtdPost' => $contaQtdPost
           , 'contaComentarioTotal' => $contaComentarioTotal
           , 'Tweet' => $Tweet
           , 'Posts' => $Posts
           , 'comentarios' => $comentarios
           , 'Users' => $User
           , 'ttSeguindos' => $Seguindo
           , 'MeuPosts' => $MeuPosts
           , 'jaSeguindo' => $jaSeguindo
           ,'sujetoes' => $sujetoes
       ]);
   }
    
    public function store(Request $request){
      $tt =  Tweet::create([
            'conteudo' => $request->field,  
            'id_usuario' => auth()->user()->id
        ]); 
        return redirect()->route('index');

    }



    public function mundo(){
        $Tweet = Tweet::get();
        $User = User::get();
      

        $Posts = DB::table('tweets')
        ->join('users','users.id', '=' ,'tweets.id_usuario')
        ->select('users.name','tweets.conteudo','tweets.created_at','tweets.id')
        ->orderByRaw('created_at DESC')
        ->get();

       $contaQtdPost = count($Posts);
       //dd($contaQtdPost);
        //*****Gerenciando comentarios 

        $comentarios = DB::table('comentarios')
        ->join('users','users.id', '=' ,'comentarios.id_usuario')
        ->join('tweets','tweets.id', '=' ,'comentarios.id_tweet')
        ->select('users.name','tweets.id','comentarios.comentario')
        ->get();


        $contaComentarioTotal = count($comentarios);
        //dd($contaComentarioTotal);

       // dd($comentarios)
        //sugestão

        return view('tt.mundo', [
            'contaQtdPost' => $contaQtdPost
           , 'contaComentarioTotal' => $contaComentarioTotal
           , 'Tweet' => $Tweet
           , 'Posts' => $Posts
           , 'comentarios' => $comentarios
           , 'Users' => $User
       ]);
    }
    public function storeSeguir(Request $request){
        $User = User::get();
        $verificaSeguir = DB::table('seguindos')
        ->select('id_usuario', 'id_usuario_seguindo')
        ->where('id_usuario', auth()->user()->id)
        ->where('id_usuario_seguindo',$request->Usuario)
        ->get();

        if(count($verificaSeguir ) >= 1){
                return "erro, você já segue esse usuario";
                
        }else{
            
        
        $tt =  Seguindo::create([
            'id_usuario' => auth()->user()->id, 
            'id_usuario_seguindo' => $request->Usuario
        ]); 
        //dd($tt);

       return redirect()->route('index');
    }
    }
}
