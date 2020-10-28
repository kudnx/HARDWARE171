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
      $visaoUsuario->formulario();
    }

    public function editar(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Usuario", "", $id);
      $id = str_replace("editar", "", $id);
      $usuario = new Usuario($id);
      $visaoUsuario = new VisaoUsuario();
      $dados = $usuario->recoverUm($id);
      $visaoUsuario->formularioEdicao($dados);
    }

    public function excluir(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Usuario", "", $id);
      $id = str_replace("excluir", "", $id);
      $modeloUsuario = new Usuario($id);
      $modeloUsuario->delete($id);
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

    public function atualizar(){
      $id = filter_input(INPUT_POST, 'id');
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
        $retorno = $modeloUsuario->update($id);

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Usuário atualizado corretamente';
        }
        else{
          $msg = 'ERRO ao atualizar o usuário';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoUsuario->mensagem('Gerenciamento de Usuários', 'Atualização de Usuários', $msg);
    }
  }
 ?>
