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

  class VisaoFornecedor{
    public function __construct(){
    }

    public function formulario(){
      $titulo = 'Gerenciamento de Fornecedores';
      $subtitulo = 'Cadastro de Fornecedores';
      $conteudo = '<form action="/HARDWARE171/Fornecedor/inserir" method="post" enctype="multipart/form-data">
      <label for="nome">Nome do Fornecedor</label>
      <input type="text" name="nome" id="nome"><br>
      <label for="nome">Imagem do Fornecedor</label>
      <input type="file" name="logo" id="logo" accept="image/*"><br>
      <button>Cadastrar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($dados){
      $dir = './Imagens/Fornecedor/';
      $titulo = 'Gerenciamento de Fornecedores';
      $subtitulo = 'Edição de Fornecedores';
      $conteudo = '<form action="/HARDWARE171/Fornecedor/atualizar" method="post" enctype="multipart/form-data">
      <input type="text" name="id" id="id" value="' . $dados['id'] .'" hidden><br>
      <label for="nome">Nome do Fornecedor</label>
      <input type="text" name="nome" id="nome" value="' . $dados['nome'] .'"><br>
      <label for="nome">Imagem do Fornecedor</label>
      <input type="file" name="logo" id="logo" value="' . $dados['logo'] .'" accept="image/*"><br>
      <button>Atualizar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $dir = '../Imagens/Fornecedor/';
      $titulo = 'Gerenciamento de Fornecedores';
      $subtitulo = 'Fornecedores Cadastrados';
      $conteudo = '';
      foreach ($lista as $fornecedor) {
        $parcial = '<p>';
        $parcial .= '<h3>' . $fornecedor['nome'] . '</h3>' .
        '<img src="'.$dir.$fornecedor['logo'].'" width="500px" height="100px"/>';
        $id = $fornecedor['id'];
        $parcial .= '<p><br>';
        $parcial .= '<a href="editar/'. $id .'"><button>Editar</button></a>';
        $parcial .= '<a href="excluir/' . $id .'"><button>Excluir</button></a>';
        $conteudo .= $parcial;
      }
      include './Visao/templates/template.php';
    }

    public function mensagem($t, $st, $msg){
      $titulo = $t;
      $subtitulo = $st;
      $conteudo = $msg;
      include './Visao/templates/template.php';
    }
  }
 ?>
