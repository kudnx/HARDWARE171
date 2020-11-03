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

  class VisaoAdmin{
    public function __construct(){
    }

    public function formulario(){
      $titulo = 'Gerenciamento de Admins';
      $subtitulo = 'Cadastro de Admins';
      $conteudo = '<form action="/HARDWARE171/Admin/inserir" method="post">
      <label for="nome">Email do administrador</label>
      <input type="email" name="email" id="email"><br>
      <label for="nome">Senha</label>
      <input type="password" name="senha" id="senha"><br>
      <button>Cadastrar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Admins';
      $subtitulo = 'Admins Cadastrados';
      $conteudo = '';
      foreach ($lista as $admins) {
        $parcial = '<p>';
        $parcial .= '<h3>' . $admins['email'] . '</h3>';
        $id = $admins['id'];
        $parcial .= '<p><br>';
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
