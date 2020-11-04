<?php
namespace HARDWARE171\Modelo;

use PDO;
use PDOException;

  class Admin
  {
    private $id;
    private $email;
    private $senha;

    public function __construct($id = null) {
      $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function setId($id){
      $this->id = $id;
    }

    public function getEmail(){
      return $this->email;
    }

    public function setEmail($email){
      $this->email = $email;
    }

    public function getSenha(){
      return $this->senha;
    }

    public function setSenha($senha){
      $this->senha = $senha;
    }

    public function create(){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'insert into admin (email, senha) values (?, ?);';
        $pre = $con->prepare($sql);
        $pre->bindValue(1, $this->email);
        $pre->bindValue(2, $this->senha);
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

    public function recoverUm($id){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = 'select * from admin where id=' . $id . ';';
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
        $sql = 'select id, email from admin';
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
         $sql = 'DELETE FROM `admin` WHERE id = ' . $id . ';';
         if ($data = $con->query($sql)) {
           echo "<script>
                  alert('Administrador excluido com sucesso!!');
                 window.location.href = 'http://localhost/HARDWARE171/Admin/ver'
                 </script>";
         }else{
           return array('status' => 'erro');
         }
       }catch(PDOException $pdoex){
         return array('status' => 'erro');
       }
    }

    public function login($email){
      $user = 'root';
      $pass = '';
      try {
        $con = new PDO('mysql:server=localhost;dbname=hardware171;port=3306', $user, $pass);
        $sql = "select id ,email, senha from admin where email='$email'";
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
