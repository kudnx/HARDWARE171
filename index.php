<?php
namespace HARDWARE171;

require_once './vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Slim\App;
use HARDWARE171\Controle\ControleAdmin;


session_start();

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App();

  $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args){
    
    echo "
      <!DOCTYPE html>
      
      <html lang='pt-br' dir='ltr'>
      
        <head>
          <meta charset='utf-8'>
          <title>Seja bem vindo!</title>      
        </head>
        <style>
        
          h1,h2{
            text-align:center;
          }
        
        </style>

        <body>
        <div class='conteudo'>
          
          
            <form action='/HARDWARE171/Admin/login' method='post' enctype='multipart/form-data' class='login-form'>
            <img src= 'Visao/templates/img/logo.svg'>	
            <h2 class='title'>SEJA BEM VINDO!</h2>
            <div class='form-group'>            
              <input  placeholder='E-mail' class='form-control' type='email' name='email' id='email' required><br>
            </div>

            <div class='form-group'>            
              <input placeholder='Senha'class='form-control' type='senha' name='senha' id='senha' accept='senha' required><br>          
            </div>

            <button class='btn btn-dark'>Login</button>

            </form>
        </div>
        </body>
      </html>

    " ;
    include 'Visao/templates/IndexTemplate.php';
   
  });

  $app->post('/Admin/{acao}', function (ServerRequestInterface $request, ResponseInterface $response, $args){
    $controleAdmin = new ControleAdmin();
    $modulo = 'HARDWARE171\\Controle\\ControleAdmin';
    $acao = $args['acao'];
    $objeto = new $modulo(null);
    $objeto->$acao();
    if ($controleAdmin->verificaLogin()){
      echo "<script>
        window.location.href = 'http://localhost/HARDWARE171/Cliente/ver';
        </script>
      ";
    }
    else{
      echo "<script>
        window.location.href = 'http://localhost/HARDWARE171/';
        </script>
      ";
    }
    
  
  });

  $app->any('/{modulo}/{acao}[/{id}]', function (ServerRequestInterface $request, ResponseInterface $response, $args){
    $controleAdmin = new ControleAdmin();
    if ($controleAdmin->verificaLogin()){
      $modulo = 'HARDWARE171\\Controle\\Controle' . $args['modulo'];
      $acao = $args['acao'];
      $parametro = null;
      if (isset($args['ref'])) {
        $parametro = $args['ref'];
      }
      $objeto = new $modulo($parametro);
      $objeto->$acao();
    }
    else {
      echo "<script>
        alert('Por favor, efetue login!');
        window.location.href = 'http://localhost/HARDWARE171/';
        </script>
      ";
    }
  });

  $app->run();
