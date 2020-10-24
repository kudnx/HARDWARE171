<?php
namespace HARDWARE171\Controle;

use HARDWARE171\Modelo\Usuario;
use HARDWARE171\Visao\VisaoUsuario;

  class ControleUsuario{
    public function __construct($parametro=null){
    }

    public function ver(){
      $usuario = new Usuario(null);
      $visaoUsuario = new VisaoUsuario();
      $visaoUsuario->listar($usuario->recover());
    }

    public function digitar(){
      $visaoUsuario = new VisaoUsuario();
      $visaoUsuario->formulario($id="", $formTipo="inserir", $dados="");
    }

    public function inserir(){
      $nome = filter_input(INPUT_POST, 'nome');
      $email = filter_input(INPUT_POST, 'email');
      $cidade = filter_input(INPUT_POST, 'cidade');

      $modeloUsuario = new Usuario(null);
      $modeloUsuario->setNome($nome);
      $modeloUsuario->setEmail($email);
      $modeloUsuario->setCidade($cidade);

      $visaoUsuario = new VisaoUsuario();
      $msg = '';

      if($nome && $email && $cidade){
        $retorno = $modeloUsuario->create();

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Usuário cadastrado corretamente';
        }
        else{
          $msg = 'ERRO, usuario não inserido na base de dados';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoUsuario->mensagem('Gerenciamento de Usuários', 'Cadastro de Usuários', $msg);
    }
  }
 ?>
