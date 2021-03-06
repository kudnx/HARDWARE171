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
?>
<?php

  class VisaoCompra{
    public function __construct(){
    }

    public function formulario($dadosfornecedor,$dadosProduto){
      $titulo = 'Gerenciamento de Compra';
      $subtitulo = 'Cadastro de Compra';
      $parcial = '<form name = "formulario1" action="/HARDWARE171/Compra/confirmacao" method="post">';
      $parcial .= ' <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
                    <h3 style = "margin-bottom:30px;color:#ced4da;">Nova Compra!</h3>  ';
      $parcial .= '<select class="form-control"  name="produto" id="produto">';
      foreach ($dadosProduto as $produto) {
        $parcial .= '<option value=' .$produto['produto_id']. '>' .$produto['produto_nome']. '</option>';
      };
      $parcial .= '</select><br>';
      $parcial .= '<label>Quantidade</label><br>';
      $parcial .= '<input class="form-control" type="number" id="quantidade" name="quantidade" min="1" required>';
      $parcial .= '</select><br><br>';
      $parcial .= '<button style="width:100%;" class="btn btn-dark" onclick=validar()>Confirmar</button>
      </div></form>';
      $conteudo = $parcial;
      include './Visao/templates/template.php';
    }

    public function confirmacao($dadosfornecedor, $dadosProduto, $quantidade){
      $dir = '../Imagens/Produto/';
      $dirFornecedor = '../Imagens/Fornecedor/';
      $titulo = 'Gerenciamento de Compras';
      $subtitulo = 'Comfirmação da Compras';
      $conteudo = '';

      $parcial = '<h1>Dados da Compra:</h1>';
      $parcial .= '<h2>Dados Fornecedor</h2>';
      $parcial .= '<h3>Nome do Fornecedor</h3>';
      $parcial .= '<h2>' .$dadosfornecedor['nome'] . '</h2>';
      $parcial .= '<img src="'.$dirFornecedor.$dadosfornecedor['logo'].'" alt='. $dadosfornecedor['nome'] .'
      width="100px" height="auto"/>';
      $parcial .= '<h2>Nome do Produto: </h1>';
      $parcial .= '<h2>' . $dadosProduto['produto_nome'] . '</h2>';
      $parcial .= '<h3>Preço do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['precoCompra'] . '</h4>';
      $parcial .= '<h3>Quantidade</h3>';
      $parcial .= '<h4>' . $dadosProduto['quantidade'] . '</h4>';
      $parcial .= '<h3>Descrição do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['descricao'] . '</h4>';
      $parcial .= '<h3>Foto do Produto </h3>';
      $parcial .= '<img src="'.$dir.$dadosProduto['foto'].'" alt='. $dadosProduto['produto_nome'] .'
      width="300px" height="auto"/>';
      $id = $dadosProduto['produto_id'];

      $parcial .= '<form action="/HARDWARE171/Compra/efetuada" method="post">';
      $parcial .= '<input type="text" name="produto_id" id="produto_id" value='.$dadosProduto['produto_id'].' hidden>';
      $parcial .= '<input type="text" name="fornecedor_id" id="fornecedor_id" value='.$dadosfornecedor['id'].' hidden>';
      $parcial .= '<input type="text" name="quantidade" id="quantidade" value='. $quantidade .' hidden>';
      $parcial .= '<button class="btn btn-dark">Confirmar</button>
                </form>';

      $conteudo = $parcial;

      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Compras';
      $subtitulo = 'Compra Realizada';
      $conteudo = '';
      $parcial = '<table class="table" border="1" style="margin:auto">';
      $parcial .= '<thead>
                 <tr>
                     <th>Data Compra</th>
                     <th>Produto Nome</th>
                     <th>Fornecedor Nome</th>
                     <th>Quantidade</th>
                 </tr>
                 </thead>';
      foreach ($lista as $compra) {
        $parcial .= '<tr>
                        <td>'.$compra['data_compra'].'</td>
                        <td>'.$compra['produto_nome'].'</td>
                        <td>'.$compra['fornecedor_nome'].'</td>
                        <td>'.$compra['quantidade'].'</td>
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
