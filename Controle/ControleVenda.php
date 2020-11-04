<?php
  namespace HARDWARE171\Controle;

  use HARDWARE171\Modelo\Produto;
  use HARDWARE171\Modelo\Venda;
  use HARDWARE171\Modelo\Usuario;
  use HARDWARE171\Modelo\Admin;
  use HARDWARE171\Visao\VisaoVenda;
  use HARDWARE171\Visao\VisaoFornecedor;
  use HARDWARE171\Visao\VisaoUsuario;

  class ControleVenda{
    private $dadosFornecedor;
    private $dadosVenda;
    private $dadosUsuario;

    public function __construct($parametro=null){
    }

    public function ver(){
      $venda = new Venda(null);
      $visaoVenda = new VisaoVenda();
      $visaoVenda->listar($venda->recover());
    }

    public function nova(){
      $visaoVenda = new VisaoVenda();
      $modeloUsuario = new Usuario();
      $modeloProduto = new Produto();
      $modeloAdmin = new Admin();
      $dadosUsuario = $modeloUsuario->recover();
      $dadosProduto = $modeloProduto->recover();
      $dadosAdmin = $_SESSION['admin'];
      $visaoVenda->formulario($dadosUsuario, $dadosProduto, $dadosAdmin);
    }

    public function confirmacao(){
      $id_usuario = filter_input(INPUT_POST, 'usuario');
      $id_produto = filter_input(INPUT_POST, 'produto');
      $id_admin = filter_input(INPUT_POST, 'admin_id');
      $usuario = new Usuario();
      $produto = new Produto();
      $admin = new Admin();
      $dadosUsuario = $usuario->recoverUm($id_usuario);
      $dadosProduto = $produto->recoverUm($id_produto);
      $dadosAdmin= $admin->recoverUm($id_admin);
      $visaoVenda = new VisaoVenda();
      $visaoVenda->confirmacao($dadosUsuario, $dadosProduto, $dadosAdmin);
    }

    public function efetuada(){
      $id_usuario = filter_input(INPUT_POST, 'usuario_id');
      $id_produto = filter_input(INPUT_POST, 'produto_id');
      $id_admin = filter_input(INPUT_POST, 'admin_id');
      $visaoVenda = new VisaoVenda();
      $msg = '';
      
      if ($id_usuario && $id_produto && $id_admin){
        $modeloVenda = new Venda();
        $modeloVenda->setId($id_usuario);
        $modeloVenda->setProduto($id_produto);
        $modeloVenda->setAdmin($id_admin);

        if($modeloVenda->create()){
          $msg = 'Venda cadastrado com sucesso';
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
