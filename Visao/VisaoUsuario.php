<?php
namespace HARDWARE171\Visao;

  class VisaoUsuario{
    public function __construct(){
    }

    public function formulario(){
      $titulo = 'Gerenciamento de Usuários';
      $subtitulo = 'Cadastro de Usuários';
      $conteudo = '<form action="/HARDWARE171/Usuario/inserir" method="post">
      <label for="nome">Nome do Usuario</label>
      <input type="text" name="nome" id="nome"><br>
      <label for="nome">Email do Usuário</label>
      <input type="email" name="email" id="email"><br>
      <label for="nome">Cidade do Usuário</label>
      <input type="text" name="cidade" id="cidade"><br>
      <button>Cadastrar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function formularioEdicao($dados){
      $titulo = 'Gerenciamento de Usuários';
      $subtitulo = 'Edição de Usuários';
      $nome = str_replace(" ", "_", $dados[0]['nome']);
      $cidade = str_replace(" ", "_", $dados[0]['cidade']);
      $conteudo = '<form action="/HARDWARE171/Usuario/atualizar" method="post">
      <input type="text" name="id" id="id" value=' . $dados[0]['id'] .' hidden><br>
      <label for="nome">Nome do Usuario</label>
      <input type="text" name="nome" id="nome" value=' . $nome .'><br>
      <label for="nome">Email do Usuário</label>
      <input type="email" name="email" id="email" value=' . $dados[0]['email'] .'><br>
      <label for="nome">Cidade do Usuário</label>
      <input type="text" name="cidade" id="cidade" value=' . $cidade .'><br>
      <button>Atualizar</button>
      </form>';
      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Usuários';
      $subtitulo = 'Usuários Cadastrados';
      $conteudo = '';
      foreach ($lista as $usuario) {
        $parcial = '<p>';
        $parcial .= '<h3>' . $usuario['nome'] . '</h3>' . $usuario['email'] .
        ', ' . $usuario['cidade'];
        $id = $usuario['id'];
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
