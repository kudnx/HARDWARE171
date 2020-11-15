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
      $conteudo = '<form action="/HARDWARE171/cliente/inserir" method="post" >
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
        <h3 style = "margin-bottom:30px;color:#ced4da;">Novo Cadastro!</h3>
        <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome do Cliente" required><br>
        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail do Cliente" required><br>
        <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Cidade do Cliente" required><br>
        <button class="btn btn-dark" style="width:100%;">Cadastrar</button>
      </div>

     
      
      </form>';
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($dados){
      $titulo = 'Gerenciamento de Clientes';
      $subtitulo = 'Edição de Clientes';
      $conteudo = '<form  action="/HARDWARE171/cliente/atualizar" method="post">
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:10px;color:#ced4da;">Editar Cliente!</h3>
        <input class="form-control" type="text" name="id" id="id" value="' . $dados[0]['id'] .'" hidden><br>
        <label for="nome">Nome do Cliente</label><br>

        <input class="form-control" type="text" name="nome" id="nome" value="' . $dados[0]['nome'] .'"><br>
        <label style="margin-top: 1rem;" for="nome">Email do Cliente</label><br>

        <input class="form-control" type="email" name="email" id="email" value="' . $dados[0]['email'] .'"><br>
        <label style="margin-top: 1rem;" for="nome">Cidade do Cliente</label><br>

        <input class="form-control" type="text" name="cidade" id="cidade" value="' . $dados[0]['cidade'] .'"><br>

        <button style="margin-top: 1rem;width:100%;" class="btn btn-success">Atualizar</button>
      </div>
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
        $parcial .= '<a href="editar/'. $id .'"><button class="btn btn-success">Editar</button></a>';
        $parcial .= '<a href="excluir/' . $id .'"><button class="btn btn-danger">Excluir</button></a>';
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
