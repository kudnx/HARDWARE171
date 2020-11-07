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

  class Visaocliente{
    public function __construct(){
    }

    public function formulario(){
      $titulo = 'Gerenciamento de Clientes';
      $subtitulo = 'Cadastro de Clientes';
      $conteudo = '<form action="/HARDWARE171/cliente/inserir" method="post">
      <label for="nome">Nome do cliente</label>
      <input type="text" name="nome" id="nome"><br>
      <label for="nome">Email do Cliente</label>
      <input type="email" name="email" id="email"><br>
      <label for="nome">Cidade do Cliente</label>
      <input type="text" name="cidade" id="cidade"><br>
      <button>Cadastrar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($dados){
      $titulo = 'Gerenciamento de Clientes';
      $subtitulo = 'Edição de Clientes';
      $conteudo = '<form action="/HARDWARE171/cliente/atualizar" method="post">
      <input type="text" name="id" id="id" value="' . $dados[0]['id'] .'" hidden><br>
      <label for="nome">Nome do cliente</label>
      <input type="text" name="nome" id="nome" value="' . $dados[0]['nome'] .'"><br>
      <label for="nome">Email do Cliente</label>
      <input type="email" name="email" id="email" value="' . $dados[0]['email'] .'"><br>
      <label for="nome">Cidade do Cliente</label>
      <input type="text" name="cidade" id="cidade" value="' . $dados[0]['cidade'] .'"><br>
      <button>Atualizar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Clientes';
      $subtitulo = 'Clientes Cadastrados';
      $conteudo = '';
      foreach ($lista as $cliente) {
        $parcial = '<p>';
        $parcial .= '<h3>' . $cliente['nome'] . '</h3>' . $cliente['email'] .
        ', ' . $cliente['cidade'];
        $id = $cliente['id'];
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
