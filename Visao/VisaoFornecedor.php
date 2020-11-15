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
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:30px;color:#ced4da;">Novo Fornecedor!</h3>

        <input class="form-control" type="text" name="nome" id="nome"  placeholder="Nome do Fornecedor" required><br>

        <label for="nome">Imagem do Fornecedor</label><br>
        <input style="padding:3px;"class="form-control" type="file" name="logo" id="logo" accept="image/*" required><br>

        <button style="margin-top: 1rem;width:100%;"class="btn btn-dark">Cadastrar</button>
      </div>
      </form>';
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($dados){
      $dir = './Imagens/Fornecedor/';
      $titulo = 'Gerenciamento de Fornecedores';
      $subtitulo = 'Edição de Fornecedores';
      $conteudo = '<form action="/HARDWARE171/Fornecedor/atualizar" method="post" enctype="multipart/form-data">

      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:10px;color:#ced4da;">Editar Fornecedor!</h3>

        <input class="form-control"  type="text" name="id" id="id" value="' . $dados['id'] .'" hidden><br>
        <label for="nome">Nome do Fornecedor</label><br>
        <input class="form-control"  type="text" name="nome" id="nome" value="' . $dados['nome'] .'"><br>
        <label style="margin-top: 1rem;" for="nome">Imagem do Fornecedor</label><br>
        <input style="padding:3px;"class="form-control" type="file" name="logo" id="logo" value="' . $dados['logo'] .'" accept="image/*"><br>
        <button style="margin-top: 1rem;width:100%" class="btn btn-success">Atualizar</button>

      </div>
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
        '<img src="'.$dir.$fornecedor['logo'].'" width="100px" height="auto"/>';
        $id = $fornecedor['id'];
        $parcial .= '<p><br>';
        $parcial .= '<a href="editar/'. $id .'"><button class="btn btn-success">Editar</button></a>';
        $parcial .= '<a href="excluir/' . $id .'"><button  class="btn btn-danger">Excluir</button></a>';
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
