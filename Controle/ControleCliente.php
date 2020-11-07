<?php
namespace HARDWARE171\Controle;

use HARDWARE171\Modelo\cliente;
use HARDWARE171\Visao\Visaocliente;

  class Controlecliente{
    public function __construct($parametro=null){
    }

    public function ver(){
      $cliente = new cliente(null);
      $visaocliente = new Visaocliente();
      $visaocliente->listar($cliente->recover());
    }

    public function digitar(){
      $visaocliente = new Visaocliente();
      $visaocliente->formulario();
    }

    public function editar(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("cliente", "", $id);
      $id = str_replace("editar", "", $id);
      $cliente = new cliente($id);
      $visaocliente = new Visaocliente();
      $dados = $cliente->recoverUm($id);
      $visaocliente->formularioEdicao($dados);
    }

    public function excluir(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("cliente", "", $id);
      $id = str_replace("excluir", "", $id);
      $modelocliente = new cliente($id);
      $modelocliente->delete($id);
    }

    public function inserir(){
      $nome = filter_input(INPUT_POST, 'nome');
      $email = filter_input(INPUT_POST, 'email');
      $cidade = filter_input(INPUT_POST, 'cidade');

      $modelocliente = new cliente(null);
      $modelocliente->setNome($nome);
      $modelocliente->setEmail($email);
      $modelocliente->setCidade($cidade);

      $visaocliente = new Visaocliente();
      $msg = '';

      if($nome && $email && $cidade){
        $retorno = $modelocliente->create();

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Cliente cadastrado corretamente';
        }
        else{
          $msg = 'ERRO, cliente não inserido na base de dados';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaocliente->mensagem('Gerenciamento de Clientes', 'Cadastro de Clientes', $msg);
    }

    public function atualizar(){
      $id = filter_input(INPUT_POST, 'id');
      $nome = filter_input(INPUT_POST, 'nome');
      $email = filter_input(INPUT_POST, 'email');
      $cidade = filter_input(INPUT_POST, 'cidade');

      $modelocliente = new cliente(null);
      $modelocliente->setNome($nome);
      $modelocliente->setEmail($email);
      $modelocliente->setCidade($cidade);

      $visaocliente = new Visaocliente();
      $msg = '';

      if($nome && $email && $cidade){
        $retorno = $modelocliente->update($id);

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Cliente atualizado corretamente';
        }
        else{
          $msg = 'ERRO ao atualizar o Cliente';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaocliente->mensagem('Gerenciamento de Clientes', 'Atualização de Clientes', $msg);
    }
  }
 ?>
