<?php
namespace HARDWARE171;

require_once './vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use Slim\App;

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App();

  $app->any('/{modulo}/{acao}[/{id}]', function (ServerRequestInterface $request, ResponseInterface $response, $args){
    $modulo = 'HARDWARE171\\Controle\\Controle' . $args['modulo'];
    $acao = $args['acao'];
    $parametro = null;
    if (isset($args['ref'])) {
      $parametro = $args['ref'];
    }
    $objeto = new $modulo($parametro);
    $objeto->$acao();
  });

  $app->run();
