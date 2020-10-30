<?php
  namespace HARDWARE171\Visao;

  class VisaoProduto{
    public function __construct()
    {

    }

    public function formulario($dadosFornecedor)
    {
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Cadastro de Produtos';
      $parcial = '<form action="/HARDWARE171/Produto/inserir" method="post" enctype="multipart/form-data">';
      $parcial .= '<label for="Fornecedor">Fornecedor</label>';
      $parcial .= '<select name="fornecedor" id="fornecedor">';
      foreach ($dadosFornecedor as $produto) {
        $parcial .= '<option value=' .$produto['id']. '>' .$produto['nome']. '</option>';
      };
      $parcial .= '</select><br>';
       $parcial .= '<label for="nome">Nome do Produto</label>
       <input type="text" name="nome" id="nome"><br>
       <label for="preco">Preço do Produto</label>
       <input type="number" name="preco" id="preco"><br>
       <label for="descricao">Descricao do Produto</label>
       <input type="text" name="descricao" id="descricao"><br>
       <label for="foto">Foto</label>
       <input id="foto" type="file" name="foto" accept="image/*"></input><br>
       <button>Cadastrar</button>
       </form>';
      $conteudo = $parcial;
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($produto){
      $dir = './Imagens/Produto/';
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Edição de Produtos';
      unlink($dir.$produto['foto']);
      $conteudo = '<form action="/HARDWARE171/Produto/atualizar" method="post" enctype="multipart/form-data">
      <input type="text" name="id" id="id" value=' . $produto['produto_id'] .' hidden>
      <input type="text" name="fornecedor_id" id="fornecedor_id" value=' . $produto['fornecedor_id'] .' hidden>
      <label for="nome">Nome do Produto</label>
      <input type="text" name="nome" id="nome" value=' . $produto['produto_nome'] .'><br>
      <label for="preco">Preço do Produto</label>
      <input type="number" name="preco" id="preco" value=' . $produto['preco'] . '><br>
      <label for="descricao">Descricao do Produto</label>
      <input type="text" name="descricao" id="descricao" value=' . $produto['descricao'] . '><br>
      <label for="foto">Foto</label>
      <input id="foto" type="file" name="foto" value=' . $produto['foto'] . ' accept="image/*"></input><br>
      <button>Atualizar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $dir = '../Imagens/Produto/';
      $titulo = 'Gerenciamento de Produtos';
      $subtitulo = 'Produtos Cadastrados';
      $conteudo = '';
      foreach ($lista as $produto) {
        $parcial = '<p>';
        $parcial .= '<h3>' . $produto['produto_nome'] . '</h3>' . '<h3>' . 'R$ ' . $produto['preco']
        . '</h3><br>' . $produto['descricao'] . '<br>' .$produto['fornecedor_nome']. '<br>'.
        '<img src="'.$dir.$produto['foto'].'" width="700px" height="300px"/>';
        $id = $produto['produto_id'];
        $parcial .= '<p><br>';
        $parcial .= '<a href="editar/'. $id .'"><button>Editar</button></a>';
        $parcial .= '<a href="excluir/' . $id .'"><button>Excluir</button></a>';
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
