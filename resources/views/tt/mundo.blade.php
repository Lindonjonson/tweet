<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Oct 16 2019 23:46:02 GMT+0000 (UTC)  -->
<html data-wf-page="5da786dd00b10d79c698bf04" data-wf-site="5da766d32783b3459dfbc795">
<head>
  <meta charset="utf-8">
  <title>Publicações</title>
  <meta content="Publicações" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="/css/normalize.css" rel="stylesheet" type="text/css">
  <link href="/css/webflow.css" rel="stylesheet" type="text/css">
  <link href="/css/desafio.webflow.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["PT Sans:400,400italic,700,700italic","Ubuntu:300,300italic,400,400italic,500,500italic,700,700italic"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <div class="topo-publicacoes w-clearfix">
   
        
  
    <div class="div-perfil">
      <p>Sugestões</p>
      @foreach ($Users as $User)
     
      @if($User->id == auth()->user()->id)
      <p class="nome-perfil">{{$User->name}}</p>
      <form id="email-form-2" name="email-form-2" data-name="Email Form 2" class="w-clearfix" action="{{route('create.seguir',['Usuario' => $User->id ])}}" method="post">
                 @csrf
                 <input type="submit" disabled  value="você" class="botao-seguir w-inline-block"></form>
    
      </form>
      @else
      <HR>
      <p class="nome-perfil">{{$User->name}}</p>
      <form id="email-form-2" name="email-form-2" data-name="Email Form 2" class="w-clearfix" action="{{route('create.seguir',['Usuario' => $User->id ])}}" method="post">
                 @csrf
                 <input type="submit" value="SEGUIR" class="botao-seguir w-inline-block"></form>
    
        
      </form>
     
      @endif


      <BR><BR>
        @endforeach
    </div>

    <div class="div-feed">
      <div class="container-publicacoes">
        <div class="bloco-publicacao">
          <div class="w-form">
            <form id="email-form" name="email-form" data-name="Email Form" method="post" action="{{route('posts.create')}}">
              @csrf
              <textarea placeholder="Texto da Publicação" maxlength="5000" id="field" name="field" class="texto-publicar w-input"></textarea>
              <input type="submit" value="Publicar" data-wait="Please wait..." class="botao-publicar w-button"></form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
        </div>
        
            
        <a href="{{route('index')}}">Voltar para minha linha do tempo</a>
        <br>
        <a href="">Ver meus seguidores</a>
        <br>  
        <a href="{{route('mundo')}}">Explorar o mundo</a>
        <br>
        <p class="feed">Global</p>
        
      
        @foreach ($Posts as $Post)  
        @if($contaComentarioTotal >=1)
         
              
          
          <div class="div-publicacao-feed">{{$Post->name}}:
            <p class="texto-publicacao">{{$Post->conteudo}}</p>
            
        
                 
       
             <div class="div-comentario-existente">
              
             
              @foreach ($comentarios as $comentario)
             @if ($Post->id == $comentario->id)
             <p class="nome-perfil-comentario">{{$comentario->name}}</p>
             <p class="comentario">{{$comentario->comentario}}</p>
             @else
                 
             @endif 
              
       
            
       
                @endforeach
           
          

   
      

            <div class="w-form">
              <form id="email-form-2" name="email-form-2" data-name="Email Form 2" class="w-clearfix" action="{{route('comentario.create',['Post' => $Post->id ])}}" method="post">
                @csrf
                <textarea placeholder="..." maxlength="5000" id="field_2" name="field_2" class="textarea w-input"></textarea>
                <input type="submit" value="Comentar" data-wait="Please wait..." class="submit-button w-button"></form>
              <div class="w-form-done">
                <div>Thank you! Your submission has been received!</div>
              </div>
              <div class="w-form-fail">
                <div>Oops! Something went wrong while submitting the form.</div>
              </div>
            </div>
          </div>
        </div>
      
  
      @else
      <div class="div-publicacao-feed">{{$Post->name}}:
        <p class="texto-publicacao">{{$Post->conteudo}}</p>
        
          <div class="div-comentario-existente">
            <div class="w-form">
              <form id="email-form-2" name="email-form-2" data-name="Email Form 2" class="w-clearfix"><textarea placeholder="..." maxlength="5000" id="field-2" name="field-2" class="textarea w-input"></textarea><input type="submit" value="Comentar" data-wait="Please wait..." class="submit-button w-button"></form>
              <div class="w-form-done">
                <div>Thank you! Your submission has been received!</div>
              </div>
              <div class="w-form-fail">
                <div>Oops! Something went wrong while submitting the form.</div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
      
    </div>
    
  </div>

  <div class="w-embed">
    <style>
 .w-webflow-badge {display: none !important;}
</style>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>