<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Compra
  {
    private $id_fornecedor;
    private $id_produto;
    private $quantidade;

    public function __construct($id_fornecedor = null) {
      $this->id_fornecedor = $id_fornecedor;
    }

    public function getProduto(){
      return $this->produto;
    }

    public function setProduto($id_produto){
      $this->id_produto = $id_produto;
    }

    public function getFornecedor(){
      return $this->fornecedor;
    }

    public function setFornecedor($fornecedor){
      $this->id_fornecedor = $fornecedor;
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
        $sql = 'insert into compra (produto_id, fornecedor_id, quantidade) values (?, ?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->id_produto);
        $pre->bindValue(2, $this->id_fornecedor);
        $pre->bindValue(3, $this->quantidade);
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

    public function recoverUm($id_fornecedor){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select * from fornecedor where id=' . $id_fornecedor . ';';
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
        $sql = 'select compra.data as data_compra, produto.nome as produto_nome, fornecedor.nome as fornecedor_nome, compra.quantidade as quantidade 
        from compra inner join produto on compra.produto_id = produto.id 
        inner join fornecedor on compra.fornecedor_id = fornecedor.id
        order by data_Compra desc';
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
