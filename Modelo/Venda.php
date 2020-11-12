<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Venda
  {
    private $id_cliente;
    private $id_produto;
    private $id_admin;
    private $quantidade;

    public function __construct($id_cliente = null) {
      $this->id = $id_cliente;
    }

    public function getId(){
      return $this->id;
    }

    public function setId($id_cliente){
      $this->id = $id_cliente;
    }

    public function getProduto(){
      return $this->produto;
    }

    public function setProduto($produto){
      $this->produto = $produto;
    }

    public function getAdmin(){
      return $this->admin;
    }

    public function setAdmin($admin){
      $this->admin = $admin;
    }
    public function getQuantidade(){
      return $this->quantidade;
    }

    public function setQuantidade($quantidade){
      $this->quantidade = $quantidade;
    }

    public function create(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'insert into venda (cliente_id, produto_id, admin_id, quantidade) values (?, ?, ?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->id);
        $pre->bindValue(2, $this->produto);
        $pre->bindValue(3, $this->admin);
        $pre->bindValue(4, $this->quantidade);
        if ($pre->execute()){
          return array('status' => 'sucesso');
        }else{
          var_dump($con->errorInfo());
          var_dump($pre->errorInfo());
          return array('status' => 'erro');
        }
      }catch(PDOException $pdoex){
        var_dump($pdoex);
        return array('status' => 'erro');
      }
    }

    public function recoverUm($id_cliente){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select * from admin where id=' . $id_cliente . ';';
        if ($data = $con->query($sql)) {
          return $data->fetchAll(PDO::FETCH_ASSOC);
        }else{
          return array('status' => 'erro');
        }
      }catch(PDOException $pdoex){
        return array('status' => 'erro');
      }
    }
    public function recoverQuantidade($id_produto){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select quantidade from produto where id=' . $id_produto . ';';
        if ($data = $con->query($sql)) {
          return $data->fetchAll(PDO::FETCH_ASSOC);
        }else{
          return array('status' => 'erro');
        }
      }catch(PDOException $pdoex){
        return array('status' => 'erro');
      }
    }

    public function recover(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select data as data_venda, produto.nome as produto_nome, produto.precoVenda
        as produto_precoVenda, venda.quantidade, admin.email as admin_email, cliente.nome as cliente_nome,
        cliente.email as cliente_email, cliente.cidade as cliente_cidade FROM venda
        inner join produto on venda.produto_id = produto.id inner join admin on
        venda.admin_id = admin.id inner join cliente on venda.cliente_id = cliente.id
        order by data_venda desc';
        if ($data = $con->query($sql)) {
          return $data->fetchAll(PDO::FETCH_ASSOC);
        }else{
          return array('status' => 'erro');
        }
      }catch(PDOException $pdoex){
        return array('status' => 'erro');
      }
    }
  }
 ?>
