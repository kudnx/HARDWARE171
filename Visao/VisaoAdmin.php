<?php
namespace HARDWARE171\Visao;

  class VisaoAdmin{
    public function __construct(){
    }

    public function formulario(){   
      $titulo = 'Gerenciamento de Admins';
      $subtitulo = 'Cadastro de Admins';
      $conteudo = '<form class="form-group" action="/HARDWARE171/Admin/inserir" method="post">
      <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
      <h3 style = "margin-bottom:30px;color:#ced4da;">Novo Administrador</h3>         

      <input class="form-control" type="email" name="email" id="email" placeholder="E-mail do administrador"><br>

      <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha do administrador"><br>
    

      <button style="margin-top: 1rem;width:100%;" class="btn btn-dark">Cadastrar</button>
      </div>
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
