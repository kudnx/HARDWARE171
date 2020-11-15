<?php
  namespace HARDWARE171\Visao;

  if(!isset($_SESSION))
  {
      session_start();
  }

  if (!$_SESSION['login'] == true){
    echo "
      <script>
        window.location.href = 'http://localhost/HARDWARE171/'
      </script>
    ";
  };

  class VisaoProduto{
    public function __construct()
    {

    }

    public function formulario($dadosFornecedor)
    {
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Cadastro de Produtos';
      $parcial = '<form action="/HARDWARE171/Produto/inserir" method="post" enctype="multipart/form-data"> 
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:30px;color:#ced4da;">Novo Produto!</h3>
      ';
      $parcial .= '<label for="Fornecedor">Fornecedor</label>';
      $parcial .= '<select class="form-control" name="fornecedor" id="fornecedor">';
      foreach ($dadosFornecedor as $produto) {
        $parcial .= '<option value=' .$produto['id']. '>' .$produto['nome']. '</option>';
      };
      $parcial .= '</select><br>';
       $parcial .= '
       <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome do Produto"><br>
      
       <input class="form-control" type="number" name="precoCompra" id="precoCompra" placeholder="Preço de Compra"><br>
       
       <input class="form-control" type="number" name="precoVenda" id="precoVenda" placeholder="Preço de Venda"><br>
       
       <input class="form-control" type="text" name="descricao" id="descricao" placeholder="Descrição do Produto"><br>
       <label for="foto">Imagem do Produto</label>
       <input   style="padding:3px;" class="form-control" id="foto" type="file" name="foto" accept="image/*"></input><br>
       <button style="margin-top: 1rem;width:100%;"class="btn btn-dark">Cadastrar</button>
       </div></form>';
      $conteudo = $parcial;
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($produto){
      $dir = './Imagens/Produto/';
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Edição de Produtos';
      $conteudo = '<form action="/HARDWARE171/Produto/atualizar" method="post" enctype="multipart/form-data">
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:30px;color:#ced4da;">Editar Produto</h3>   

        <input class="form-control" type="text" name="id" id="id" value="' . $produto['produto_id'] .'" hidden>
        <input class="form-control" type="text" name="fornecedor_id" id="fornecedor_id" value=' . $produto['fornecedor_id'] .' hidden>

        <label for="nome">Nome do Produto</label>
        <input class="form-control" type="text" name="nome" id="nome" value="' . $produto['produto_nome'] .'"><br>

        <label for="precoCompra">Preço de Compra</label>
        <input class="form-control" type="number" name="precoCompra" id="precoCompra" value="' . $produto['precoCompra'] . '"><br>

        <label for="precoVenda">Preço de Venda</label>
        <input class="form-control" type="number" name="precoVenda" id="precoVenda" value="' . $produto['precoVenda'] . '"><br>

        <label for="descricao">Descricao do Produto</label>
        <input class="form-control" type="text" name="descricao" id="descricao" value="' . $produto['descricao'] . '"><br>

        <label for="foto">Foto</label>
        <input style="padding:3px;" class="form-control" id="foto" type="file" name="foto" value="' . $produto['foto'] . '" accept="image/*"></input><br>

        <button style="margin-top: 1rem;width:100%;" class="btn btn-success">Atualizar</button>

      </div>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $dir = '../Imagens/Produto/';
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Produtos Cadastrados';
      $conteudo = '';
      foreach ($lista as $produto) {
        $parcial = '<div class="Produto">';
        
        $parcial .= '<div class="descricaoProduto"><h3>' . $produto['produto_nome'] . '</h3>' . '<h3>Preço de Compra: ' . 'R$ ' . $produto['precoCompra']
        . '</h3><br>' . '<h3>Preço de Venda: ' . 'R$ ' . $produto['precoVenda']
        . '</h3><br>' . '<h3>Quantidade em Estoque: ' . $produto['quantidade']
        . '</h3><br>' . '<h3> Descrição: ' . $produto['descricao'] 
        . '</h3><br>'  . '<h3> Fornecedor: '.$produto['fornecedor_nome']
        . '</h3><br></div>' .
        
        '<div class="imagemProduto"><img src="'.$dir.$produto['foto'].'" width="300px" height="auto"/>';
        $parcial .= '</div>';
        $id = $produto['produto_id'];
        $parcial .= '<div class="ctaProduto"><br>';
        $parcial .= '<a href="editar/'. $id .'"><button class="btn btn-success">Editar</button></a>';
        $parcial .= '<a href="excluir/' . $id .'"><button class="btn btn-danger">Excluir</button></a></div>';
        $conteudo .= $parcial;
      }
      include './Visao/templates/template.php';
    }

    public function mensagem($t, $st, $msg)
    {
      $titulo = $t;
      $subtitulo = $st;
      $conteudo = $msg;
      include './Visao/templates/template.php';
    }
  }
 ?>
