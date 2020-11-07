<?php
  namespace HARDWARE171\Controle;

  use HARDWARE171\Modelo\Produto;
  use HARDWARE171\Modelo\Compra;
  use HARDWARE171\Modelo\Fornecedor;
  use HARDWARE171\Visao\VisaoCompra;
  use HARDWARE171\Visao\VisaoFornecedor;
  use HARDWARE171\Visao\VisaoProduto;

  class ControleCompra{
    private $dadosFornecedor;
    private $dadosCompra;
    private $dadoscliente;

    public function __construct($parametro=null){
    }

    public function ver(){
      $compra = new Compra(null);
      $visaoCompra = new VisaoCompra();
      $visaoCompra->listar($compra->recover());
    }

    public function nova(){
      $visaoCompra = new VisaoCompra();
      $modeloFornecedor = new Fornecedor();
      $modeloProduto = new Produto();
      $dadosFornecedor = $modeloFornecedor->recover();
      $dadosProduto = $modeloProduto->recover();
      $visaoCompra->formulario($dadosFornecedor, $dadosProduto);
    }

    public function confirmacao(){
      $id_produto = filter_input(INPUT_POST, 'produto');
      $quantidade = filter_input(INPUT_POST, 'quantidade');
      $fornecedor = new Fornecedor();
      $produto = new Produto();
      $dadosProduto = $produto->recoverUm($id_produto);
      $id_fornecedor = $dadosProduto['fornecedor_id'];
      $dadosFornecedor = $fornecedor->recoverUm($id_fornecedor);
      $visaoCompra = new VisaoCompra();
      $visaoCompra->confirmacao($dadosFornecedor, $dadosProduto, $quantidade);
    }

    public function efetuada(){
      $id_fornecedor = filter_input(INPUT_POST, 'fornecedor_id');
      $id_produto = filter_input(INPUT_POST, 'produto_id');
      $quantidade = filter_input(INPUT_POST, 'quantidade');
      $visaoCompra = new VisaoCompra();
      $msg = '';
      
      if ($id_fornecedor && $id_produto && $quantidade){
        $modeloCompra = new Compra();
        $modeloCompra->setProduto($id_produto);
        $modeloCompra->setFornecedor($id_fornecedor);
        $modeloCompra->setQuantidade($quantidade);

        if($modeloCompra->create()){
          $msg = 'Compra cadastrado com sucesso';
        } else {
          $msg = 'ERRO, Compra nao inserida na base de dados';
        }
      } else {
        $msg = 'Dados ausentes ou incorretos!';
      }
      $visaoCompra->mensagem('Gerenciamento de Compras', 'Cadastro de produtos', $msg);
    }

  }
 ?>
