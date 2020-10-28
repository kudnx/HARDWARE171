<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Usuario
  {
    private $id;
    private $nome;
    private $email;
    private $cidade;

    public function __construct($id = null) {
      $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function setId($id){
      $this->id = $id;
    }

    public function getNome(){
      return $this->nome;
    }

    public function setNome($nome){
      $this->nome = $nome;
    }

    public function getEmail(){
      return $this->email;
    }

    public function setEmail($email){
      $this->email = $email;
    }

    public function getCidade(){
      return $this->cidade;
    }

    public function setCidade($cidade){
      $this->cidade = $cidade;
    }

    public function create(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'insert into usuario (nome, email, cidade) values (?, ?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->nome);
        $pre->bindValue(2, $this->email);
        $pre->bindValue(3, $this->cidade);
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

    public function update($id){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'update usuario set nome = ?, email = ?, cidade = ? where id= ' . $id .';';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->nome);
        $pre->bindValue(2, $this->email);
        $pre->bindValue(3, $this->cidade);
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
        $sql = 'select id, nome, email, cidade from usuario order by nome asc;';
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
        $sql = 'select * from usuario where id =' . $id . ';';
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
         $sql = 'DELETE FROM `usuario` WHERE id = ' . $id . ';';
         if ($data = $con->query($sql)) {
           echo "<script>
                  alert('Usuário excluido com sucesso!!');
                 window.location.href = 'http://localhost/HARDWARE171/Usuario/ver'
                 </script>";
         }else{
           return array('status' => 'erro');
         }
       }catch(PDOException $pdoex){
         return array('status' => 'erro');
       }
    }
  }
 ?>
