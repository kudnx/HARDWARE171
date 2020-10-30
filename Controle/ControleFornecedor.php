<?php
  namespace HARDWARE171\Controle;

  use HARDWARE171\Modelo\Fornecedor;
  use HARDWARE171\Visao\VisaoFornecedor;

  class ControleFornecedor{
    public function __construct($parametro=null){
    }

    public function ver(){
      $fornecedor = new Fornecedor(null);
      $visaoFornecedor = new visaoFornecedor();
      $visaoFornecedor->listar($fornecedor->recover());
    }

    public function digitar(){
      $visaoFornecedor = new visaoFornecedor();
      $visaoFornecedor->formulario();
    }

    public function editar(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Fornecedor", "", $id);
      $id = str_replace("editar", "", $id);
      $fornecedor = new Fornecedor($id);
      $visaoFornecedor = new visaoFornecedor();
      $dados = $fornecedor->recoverUm($id);
      $visaoFornecedor->formularioEdicao($dados);
    }

    public function excluir(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Fornecedor", "", $id);
      $id = str_replace("excluir", "", $id);
      $modeloFornecedor = new Fornecedor($id);
      $modeloFornecedor->delete($id);
    }

    public function inserir(){
      $dir = './Imagens/Fornecedor/';
      $nome = filter_input(INPUT_POST, 'nome');
      $logo = $_FILES['logo']['name'];

      //salvando Imagem
      if (isset($_FILES['logo'])){
        move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$logo);
      }

      $modeloFornecedor = new Fornecedor(null);
      $modeloFornecedor->setNome($nome);
      $modeloFornecedor->setImagem($logo);

      $visaoFornecedor = new visaoFornecedor();
      $msg = '';

      if($nome && $logo){
        $retorno = $modeloFornecedor->create();

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Fornecedor cadastrado corretamente';
        }
        else{
          $msg = 'ERRO, fornecedor não inserido na base de dados';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoFornecedor->mensagem('Gerenciamento de Fornecedores', 'Cadastro de fornecedores', $msg);
    }

    public function atualizar(){
      $dir = './Imagens/Fornecedor/';
      $id = filter_input(INPUT_POST, 'id');
      $nome = filter_input(INPUT_POST, 'nome');
      $logo = $_FILES['logo']['name'];

      $modeloFornecedor = new Fornecedor(null);
      $modeloFornecedor->setNome($nome);
      $modeloFornecedor->setImagem($logo);

      $visaoFornecedor = new visaoFornecedor();
      $msg = '';

      //salvando Imagem
      if (isset($_FILES['logo'])){
        move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$logo);
      }

      if($nome && $logo){
        $retorno = $modeloFornecedor->update($id);

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Fornecedor atualizado corretamente';
        }
        else{
          $msg = 'ERRO ao atualizar o fornecedor';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoFornecedor->mensagem('Gerenciamento de Fornecedores', 'Atualização de Fornecedores', $msg);
    }
  }
 ?>
