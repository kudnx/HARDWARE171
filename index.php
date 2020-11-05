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
        <body>
          <h1>Login</h1>
          <form action='/HARDWARE171/Admin/login' method='post' enctype='multipart/form-data'>
          <label for='nome'>Digite o email cadastrado</label>
          <input type='email' name='email' id='email'><br>
          <label for='nome'>Digite a sua senha</label>
          <input type='senha' name='senha' id='senha' accept='senha'><br>
          <button>Login</button>
          </form>
        </body>
      </html>
    ";
  });

  $app->any('/Admin/{acao}', function (ServerRequestInterface $request, ResponseInterface $response, $args){
    $controleAdmin = new ControleAdmin();
    $modulo = 'HARDWARE171\\Controle\\ControleAdmin';
    $acao = $args['acao'];
    $objeto = new $modulo(null);
    $objeto->$acao();
    if ($controleAdmin->verificaLogin()){
      echo "<script>
        window.location.href = 'http://localhost/HARDWARE171/Usuario/ver';
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
