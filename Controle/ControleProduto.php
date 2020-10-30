<?php
  namespace HARDWARE171\Controle;

  use HARDWARE171\Modelo\Fornecedor;
  use HARDWARE171\Modelo\Produto;
  use HARDWARE171\Visao\VisaoProduto;

  class ControleProduto{
    private $dadosFornecedor;

    public function __construct($parametro=null){
    }

    public function ver(){
      $produto = new Produto(null);
      $visaoProduto = new VisaoProduto();
      $visaoProduto->listar($produto->recover());
    }

    public function digitar(){
      $visaoProduto = new VisaoProduto();
      $modeloFornecedor = new Fornecedor();
      $dadosFornecedor = $modeloFornecedor->recover();
      $visaoProduto->formulario($dadosFornecedor);
    }

    public function editar(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Produto", "", $id);
      $id = str_replace("editar", "", $id);
      $produto = new Produto($id);
      $visaoProduto = new visaoProduto();
      $dados = $produto->recoverUm($id);
      $visaoProduto->formularioEdicao($dados);
    }

    public function inserir(){
      $dir = './Imagens/Produto/';
      $fornecedor = filter_input(INPUT_POST, 'fornecedor');
      $nome = filter_input(INPUT_POST, 'nome');
      $preco = filter_input(INPUT_POST, 'preco');
      $descricao = filter_input(INPUT_POST, 'descricao');
      $foto = $_FILES['foto']['name'];
      $visaoProduto = new VisaoProduto();
      $msg = '';

      //salvando Imagem
      if (isset($_FILES['foto'])){
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$foto);
      }

      if (isset($fornecedor) && $nome && $preco && $descricao){
        $modeloProduto = new Produto();
        $modeloProduto->setFornecedor($fornecedor);
        $modeloProduto->setnome($nome);
        $modeloProduto->setpreco($preco);
        $modeloProduto->setdescricao($descricao);
        $modeloProduto->setfoto($foto);

        if($modeloProduto->create()){
          $msg = 'Produto cadastrado com sucesso';
        } else {
          $msg = 'ERRO, produto nao inserido na base de dados';
        }
      } else {
        $msg = 'Dados ausentes ou incorretos!';
      }
      $visaoProduto->mensagem('Gerenciamento de Produtos', 'Cadastro de produtos', $msg);
    }

    public function excluir(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Produto", "", $id);
      $id = str_replace("excluir", "", $id);
      $modeloroduto = new Produto($id);
      $modeloroduto->delete($id);
    }

    public function atualizar(){
      $dir = './Imagens/Produto/';
      $id = filter_input(INPUT_POST, 'id');
      $fornecedor_id = filter_input(INPUT_POST, 'fornecedor_id');
      $nome = filter_input(INPUT_POST, 'nome');
      $preco = filter_input(INPUT_POST, 'preco');
      $descricao = filter_input(INPUT_POST, 'descricao');
      $foto = $_FILES['foto']['name'];

      //salvando Imagem
      if (isset($_FILES['foto'])){
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$foto);
      }

      $modeloProduto = new Produto(null);
      $modeloProduto->setNome($nome);
      $modeloProduto->setPreco($preco);
      $modeloProduto->setDescricao($descricao);
      $modeloProduto->setFoto($foto);

      $visaoProduto = new visaoProduto();
      $msg = '';

      if($nome && $preco && $descricao && $foto){
        $retorno = $modeloProduto->update($id);

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Produto atualizado corretamente';
        }
        else{
          $msg = 'ERRO ao atualizar o Produto';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoProduto->mensagem('Gerenciamento de Produtos', 'Atualização de Produtos', $msg);
    }
  }
 ?>
