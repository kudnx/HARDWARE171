<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Venda
  {
    private $id_usuario;
    private $id_produto;
    private $id_admin;

    public function __construct($id_usuario = null) {
      $this->id = $id_usuario;
    }

    public function getId(){
      return $this->id;
    }

    public function setId($id_usuario){
      $this->id = $id_usuario;
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

    public function create(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'insert into venda (usuario_id, produto_id, admin_id) values (?, ?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->id);
        $pre->bindValue(2, $this->produto);
        $pre->bindValue(3, $this->admin);
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

    public function recoverUm($id_usuario){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select * from admin where id=' . $id_usuario . ';';
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
        $sql = 'select data as data_venda, produto.nome as produto_nome, produto.preco
        as produto_preco, admin.email as admin_email, usuario.nome as usuario_nome,
        usuario.email as usuario_email, usuario.cidade as usuario_cidade FROM venda
        inner join produto on venda.produto_id = produto.id inner join admin on
        venda.admin_id = admin.id inner join usuario on venda.usuario_id = usuario.id
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
