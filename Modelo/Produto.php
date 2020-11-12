<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Produto
  {
    private $id;
    private $fornecedor_id;
    private $nome;
    private $preco;
    private $descricao;
    private $foto;

    public function __construct($id=null) {
      $this->id = $id;
    }

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getFornecedor() {
      return $this->fornecedor_id;
    }

    public function setFornecedor($fornecedor_id) {
      $this->fornecedor_id = $fornecedor_id;
    }

    public function getNome() {
      return $this->nome;
    }

    public function setNome($nome) {
      $this->nome = $nome;
    }

    public function getprecoCompra() {
      return $this->precoCompra;
    }

    public function setprecoCompra($precoCompra) {
      $this->precoCompra = $precoCompra;
    }

    public function getprecoVenda() {
      return $this->precoCompra;
    }

    public function setprecoVenda($precoVenda) {
      $this->precoVenda = $precoVenda;
    }

    public function getdescricao() {
      return $this->descricao;
    }

    public function setdescricao($descricao) {
      $this->descricao = $descricao;
    }

    public function getFoto() {
      return $this->foto;
    }

    public function setFoto($foto) {
      $this->foto = $foto;
    }

    public function create(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'insert into produto (fornecedor_id, nome, precoCompra, precoVenda, descricao, foto) values (?, ?, ?, ?, ?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->fornecedor_id);
        $pre->bindValue(2, $this->nome);
        $pre->bindValue(3, $this->precoCompra);
        $pre->bindValue(4, $this->precoVenda);
        $pre->bindValue(5, $this->descricao);
        $pre->bindValue(6, $this->foto);
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

    public function recover(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select produto.id as produto_id, fornecedor_id, produto.nome as produto_nome,
         precoCompra, precoVenda, quantidade, descricao, foto, fornecedor.id as fornecedor_id, fornecedor.nome as fornecedor_nome,
          logo from produto inner join fornecedor on produto.fornecedor_id = fornecedor.id';
        if ($data = $con->query($sql)) {
          return $data->fetchAll(PDO::FETCH_ASSOC);
        }else{
          return array('status' => 'erro');
        }
      }catch(PDOException $pdoex){
        return array('status' => 'erro');
      }
    }

    public function recoverUm($id){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select produto.id as produto_id, fornecedor_id, produto.nome as produto_nome,
         precoCompra, precoVenda, quantidade, descricao, foto, fornecedor.id as fornecedor_id, fornecedor.nome as fornecedor_nome,
          logo from produto inner join fornecedor on produto.fornecedor_id = fornecedor.id
          where produto.id =' . $id . ';';
        if ($data = $con->query($sql)) {
          return $data->fetchAll(PDO::FETCH_ASSOC)[0];
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

    public function delete($id){
       $user = 'root';
       $pass = '';
       try {
         $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
         $sql = 'DELETE FROM `produto` WHERE id = ' . $id . ';';
         if ($data = $con->query($sql)) {
           echo "<script>
                  alert('Produto excluido com sucesso!!');
                 window.location.href = 'http://localhost/HARDWARE171/Produto/ver'
                 </script>";
         }else{
           return array('status' => 'erro');
         }
       }catch(PDOException $pdoex){
         return array('status' => 'erro');
       }
    }

    public function update($id){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'update produto set nome = ?, precoCompra = ?, precoVenda = ?, descricao = ?, foto = ? where id= ' . $id .';';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->nome);
        $pre->bindValue(2, $this->precoCompra);
        $pre->bindValue(3, $this->precoVenda);
        $pre->bindValue(4, $this->descricao);
        $pre->bindValue(5, $this->foto);
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
  }
?>
