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
  class VisaoVenda{
    public function __construct(){
    }
    public function quantidade($quantidade){
      echo $quantidade;
    }
    public function formulario($dadoscliente,$dadosProduto,$dadosAdmin){
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Cadastro de Vendas';
      $parcial = '<form action="/HARDWARE171/Venda/confirmacao" method="post" id="formulario1">';
      $parcial .= ' <div class="form-group" style="width: 421px; margin: 0 auto;border: 1px solid #ced4da; padding: 24px;">
                    <h3 style = "margin-bottom:30px;color:#ced4da;">Nova Venda!</h3>   ';
      $parcial .= '<p>Cliente</p>';
      $parcial .= '<select class="form-control" name="cliente" id="cliente">';

      foreach ($dadoscliente as $cliente) {
        $parcial .= '<option  id="titre" value=' .$cliente['id']. '>' .$cliente['nome']. '</option>';
      };
      $parcial .= '</select><br><br>';
      $parcial .= '<p>Produto</p>';
      $parcial .= '<select class="form-control" name="produto" id="produto" required >';
      $parcial .= '<option value="invalid">--</option>';
      foreach ($dadosProduto as $produto) {
        $parcial .= '<option  value=' .$produto['produto_id']. '>' .$produto['produto_nome']. '</option>';
      };
      $parcial .= '</select><br><br>';
      $parcial .= '<p>Quantidade</p>';
      $parcial .= '<input class="form-control"  type="number" name="quantidade" id="quantidade" min="1" max="10" required</option><br>';
      $parcial .= '<input class="form-control"  type="text" name="admin_id" id="admin_id" value='.$dadosAdmin.' hidden>';
      $parcial .= '<button style="margin-top: 1rem;width:100%" class="btn btn-dark" id="confirmar1">Confirmar</button>
                </div></form>';
      $conteudo = $parcial;
      include './Visao/templates/template.php';
    }

    public function confirmacao($dadoscliente, $dadosProduto, $dadosAdmin, $quantidade){
      $dir = '../Imagens/Produto/';
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Comfirmação da Venda';
      $conteudo = '';

      $parcial = '<h1>Dados do Cliente<h1>';
      $parcial .= '<p>';
      $parcial .= '<h2>Nome do Cliente: </h2>';
      $parcial .= '<h3>' . $dadoscliente[0]['nome'] . '</h3>';
      $parcial .= '<h2>Email do Cliente: </h2>';
      $parcial .= '<h3>' . $dadoscliente[0]['email'] . '</h3>';
      $parcial .= '<h2>Cidade do Cliente: </h2>';
      $parcial .= '<h3>' . $dadoscliente[0]['cidade'] . '</h3>';
      $id = $dadoscliente[0]['id'];

      $parcial .= '<br><br>';
      $parcial .= '<h1>Dados da compra:</h1>';
      $parcial .= '<p>';
      $parcial .= '<h1>Nome do Produto: </h1>';
      $parcial .= '<h2>' . $dadosProduto['produto_nome'] . '</h2>';
      $parcial .= '<h3>Preço do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['precoVenda'] . '</h4>';
      $parcial .= '<h3>Quantidade</h3>';
      $parcial .= '<h4>' . $quantidade . '</h4>';
      $parcial .= '<h3>Descrição do Produto: </h3>';
      $parcial .= '<h4>' . $dadosProduto['descricao'] . '</h4>';
      $parcial .= '<h3>Foto do Produto </h3>';
      $parcial .= '<img src="'.$dir.$dadosProduto['foto'].'" alt='. $dadosProduto['produto_nome'] .'
      width="300px" height="auto"/>';
      $id = $dadosProduto['produto_id'];

      $parcial .= '<br><br>';
      $parcial .= '<h1>Dados do Administrador:</h1>';
      $parcial .= '<p>';
      $parcial .= '<h1>Email do Administrador: </h1>';
      $parcial .= '<h2>' . $dadosAdmin[0]['email'] . '</h2>';

      $parcial .= '<form action="/HARDWARE171/Venda/efetuada" method="post">';
      $parcial .= '<input type="text" name="cliente_id" id="cliente_id" value='.$dadoscliente[0]['id'].' hidden>';
      $parcial .= '<input type="text" name="quantidade" id="quantidade" value="'.$quantidade.'" hidden>';
      $parcial .= '<input type="text" name="produto_id" id="produto_id" value='.$dadosProduto['produto_id'].' hidden>';
      $parcial .= '<input type="text" name="admin_id" id="admin_id" value='.$dadosAdmin[0]['id'].' hidden>';
      $parcial .= '<button class="btn btn-dark">Confirmar</button>
                </form>';

      $conteudo = $parcial;

      include './Visao/templates/template.php';
    }

    public function listar($lista){
      $titulo = 'Gerenciamento de Vendas';
      $subtitulo = 'Vendas Realizadas';
      $conteudo = '';
      $parcial = '<table class="table" border="1" style="margin:auto">';
      $parcial .= '<thead>
                 <tr>
                     <th scope="col">Data Venda</th>
                     <th scope="col">Produto Nome</th>
                     <th scope="col">Produto Preço</th>
                     <th scope="col">Quantidade</th>
                     <th scope="col">Email do administardor</th>
                     <th scope="col">Nome do Cliente</th>
                     <th scope="col">Email do Cliente</th>
                     <th scope="col">Cidade do Cliente</th>
                 </tr>
                 </thead>';
      foreach ($lista as $venda) {
        $parcial .= '<tr>
                        <td >'.$venda['data_venda'].'</td>
                        <td>'.$venda['produto_nome'].'</td>
                        <td>'.$venda['produto_precoVenda'].'</td>
                        <td>'.$venda['quantidade'].'</td>
                        <td>'.$venda['admin_email'].'</td>
                        <td>'.$venda['cliente_nome'].'</td>
                        <td>'.$venda['cliente_email'].'</td>
                        <td>'.$venda['cliente_cidade'].'</td>
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
