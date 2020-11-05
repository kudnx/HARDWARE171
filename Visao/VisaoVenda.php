<?php
namespace HARDWARE171\Visao;

  class VisaoVenda{
    public function __construct(){
    }

    public function formulario($dadosUsuario,$dadosProduto,$dadosAdmin){
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Cadastro de Vendas';
      $parcial = '<form action="/HARDWARE171/Venda/confirmacao" method="post">';
      $parcial .= '<select name="usuario" id="usuario">';

      foreach ($dadosUsuario as $usuario) {
        $parcial .= '<option value=' .$usuario['id']. '>' .$usuario['nome']. '</option>';
      };
      $parcial .= '</select><br><br>';
      $parcial .= '<select name="produto" id="produto">';
      foreach ($dadosProduto as $produto) {
        $parcial .= '<option value=' .$produto['produto_id']. '>' .$produto['produto_nome']. '</option>';
      };
      $parcial .= '</select><br><br>';
      $parcial .= '<input type="text" name="admin_id" id="admin_id" value='.$dadosAdmin.' hidden>';
      $parcial .= '<button>Confirmar</button>
                </form>';
      $conteudo = $parcial;
      include './Visao/templates/template.php';
    }

    public function confirmacao($dadosUsuario, $dadosProduto, $dadosAdmin){
      $dir = '../Imagens/Produto/';
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Comfirmação da Venda';
      $conteudo = '';

      $parcial = '<h1>Dados do Usuário<h1>';
      $parcial .= '<p>';
      $parcial .= '<h2>Nome do Usuário: </h2>';
      $parcial .= '<h3>' . $dadosUsuario[0]['nome'] . '</h3>';
      $parcial .= '<h2>Email do Usuário: </h2>';
      $parcial .= '<h3>' . $dadosUsuario[0]['email'] . '</h3>';
      $parcial .= '<h2>Cidade do Usuário: </h2>';
      $parcial .= '<h3>' . $dadosUsuario[0]['cidade'] . '</h3>';
      $id = $dadosUsuario[0]['id'];

      $parcial .= '<br><br>';
      $parcial .= '<h1>Dados da compra:</h1>';
      $parcial .= '<p>';
      $parcial .= '<h1>Nome do Produto: </h1>';
      $parcial .= '<h2>' . $dadosProduto['produto_nome'] . '</h2>';
      $parcial .= '<h3>Preço do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['preco'] . '</h4>';
      $parcial .= '<h3>Descrição do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['descricao'] . '</h4>';
      $parcial .= '<h3>Foto do Produto </h3>';
      $parcial .= '<img src="'.$dir.$dadosProduto['foto'].'" alt='. $dadosProduto['produto_nome'] .'
      width="700px" height="300px"/>';
      $id = $dadosProduto['produto_id'];

      $parcial .= '<br><br>';
      $parcial .= '<h1>Dados do Administrador:</h1>';
      $parcial .= '<p>';
      $parcial .= '<h1>Email do Administrador: </h1>';
      $parcial .= '<h2>' . $dadosAdmin[0]['email'] . '</h2>';

      $parcial .= '<form action="/HARDWARE171/Venda/efetuada" method="post">';
      $parcial .= '<input type="text" name="usuario_id" id="usuario_id" value='.$dadosUsuario[0]['id'].' hidden>';
      $parcial .= '<input type="text" name="produto_id" id="produto_id" value='.$dadosProduto['produto_id'].' hidden>';
      $parcial .= '<input type="text" name="admin_id" id="admin_id" value='.$dadosAdmin[0]['id'].' hidden>';
      $parcial .= '<button>Confirmar</button>
                </form>';

      $conteudo = $parcial;

      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Vendas Realizadas';
      $conteudo = '';
      $parcial = '<table border="1" style="margin:auto">';
      $parcial .= '<thead>
                 <tr>
                     <th>Data Venda</th>
                     <th>Produto Nome</th>
                     <th>Produto Preço</th>
                     <th>Email do administardor</th>
                     <th>Nome do Usuário</th>
                     <th>Email do Usuário</th>
                     <th>Cidade do Usuário</th>
                 </tr>
                 </thead>';
      foreach ($lista as $venda) {
        $parcial .= '<tr>
                        <td>'.$venda['data_venda'].'</td>
                        <td>'.$venda['produto_nome'].'</td>
                        <td>'.$venda['produto_preco'].'</td>
                        <td>'.$venda['admin_email'].'</td>
                        <td>'.$venda['usuario_nome'].'</td>
                        <td>'.$venda['usuario_email'].'</td>
                        <td>'.$venda['usuario_cidade'].'</td>
                    </tr>';
      };
      $parcial .= '</table>';
      $conteudo = $parcial;
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
