<?php
  namespace HARDWARE171\Controle;

  use HARDWARE171\Modelo\Produto;
  use HARDWARE171\Modelo\Venda;
  use HARDWARE171\Modelo\cliente;
  use HARDWARE171\Modelo\Admin;
  use HARDWARE171\Visao\VisaoVenda;
  use HARDWARE171\Visao\VisaoFornecedor;
  use HARDWARE171\Visao\Visaocliente;

  class ControleVenda{
    private $dadosFornecedor;
    private $dadosVenda;
    private $dadoscliente;

    public function __construct($parametro=null){
    }

    public function ver(){
      $venda = new Venda(null);
      $visaoVenda = new VisaoVenda();
      $visaoVenda->listar($venda->recover());
    }

    public function nova(){
      $visaoVenda = new VisaoVenda();
      $modelocliente = new cliente();
      $modeloProduto = new Produto();
      $modeloAdmin = new Admin();
      $dadoscliente = $modelocliente->recover();
      $dadosProduto = $modeloProduto->recover();
      $dadosAdmin = $_SESSION['admin'];
      $visaoVenda->formulario($dadoscliente, $dadosProduto, $dadosAdmin);
    }

    public function confirmacao(){
      $id_cliente = filter_input(INPUT_POST, 'cliente');
      $id_produto = filter_input(INPUT_POST, 'produto');
      $id_admin = filter_input(INPUT_POST, 'admin_id');
      $quantidade = filter_input(INPUT_POST, 'quantidade');
      $cliente = new cliente();
      $produto = new Produto();
      $admin = new Admin();
      $dadoscliente = $cliente->recoverUm($id_cliente);
      $dadosProduto = $produto->recoverUm($id_produto);
      $dadosAdmin= $admin->recoverUm($id_admin);
      $visaoVenda = new VisaoVenda();
      $visaoVenda->confirmacao($dadoscliente, $dadosProduto, $dadosAdmin, $quantidade);
    }

    public function quantidade(){
      $id_produto = filter_input(INPUT_POST, 'produto_id');
      $venda = new Venda();
      $quantidade = $venda->recoverQuantidade($id_produto);
      $visaoVenda = new VisaoVenda();
      $visaoVenda->quantidade($quantidade[0]['quantidade']);
    }

    public function efetuada(){
      $id_cliente = filter_input(INPUT_POST, 'cliente_id');
      $id_produto = filter_input(INPUT_POST, 'produto_id');
      $id_admin = filter_input(INPUT_POST, 'admin_id');
      $quantidade = filter_input(INPUT_POST, 'quantidade');
      $visaoVenda = new VisaoVenda();
      var_dump($quantidade);
      $msg = '';
      
      if ($id_cliente && $id_produto && $id_admin && $quantidade){
        $modeloVenda = new Venda();
        $modeloVenda->setId($id_cliente);
        $modeloVenda->setProduto($id_produto);
        $modeloVenda->setAdmin($id_admin);
        $modeloVenda->setQuantidade($quantidade);

        if($modeloVenda->create()){
          $msg = 'Venda cadastrado com sucesso';
          var_dump($quantidade);
        } else {
          $msg = 'ERRO, venda nao inserida na base de dados';
        }
      } else {
        $msg = 'Dados ausentes ou incorretos!';
      }
      $visaoVenda->mensagem('Gerenciamento de Vendas', 'Cadastro de produtos', $msg);
    }

  }
 ?>
