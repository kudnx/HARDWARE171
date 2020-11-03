<?php
namespace HARDWARE171\Controle;

if(!isset($_SESSION))
{
    session_start();
}

use HARDWARE171\Modelo\Admin;
use HARDWARE171\Visao\VisaoAdmin;

  class ControleAdmin{
    public function __construct($parametro=null){
    }

    public function ver(){
      $admin = new Admin(null);
      $visaoAdmin = new VisaoAdmin();
      $visaoAdmin->listar($admin->recover());
    }

    public function digitar(){
      $visaoAdmin = new VisaoAdmin();
      $visaoAdmin->formulario();
    }

    public function sair(){
      session_destroy();
      echo "
        <script>
          window.location.href = 'http://localhost/HARDWARE171/'
        </script>
      ";
    }

    public function excluir(){
      $id = $_SERVER['REQUEST_URI'];
      $id = str_replace("/", "", $id);
      $id = str_replace("HARDWARE171", "", $id);
      $id = str_replace("Admin", "", $id);
      $id = str_replace("excluir", "", $id);
      $modeloAdmin = new Admin($id);
      $modeloAdmin->delete($id);
    }

    public function inserir(){
      $email = filter_input(INPUT_POST, 'email');
      $senha = filter_input(INPUT_POST, 'senha');

      $senha = md5($senha);

      $modeloAdmin = new Admin(null);
      $modeloAdmin->setEmail($email);
      $modeloAdmin->setsenha($senha);

      $visaoAdmin = new VisaoAdmin();
      $msg = '';

      if($email && $senha){
        $retorno = $modeloAdmin->create();

        if(strcmp($retorno['status'], 'sucesso') == 0){
          $msg = 'Administrador cadastrado corretamente';
        }
        else{
          $msg = 'ERRO, administrador não inserido na base de dados';
      }
    }
      else{
        $msg = 'Dados ausentes ou incorretos';
      }
      $visaoAdmin->mensagem('Gerenciamento de Administradores', 'Cadastro de Administradores', $msg);
    }

    public function login(){
      $email = filter_input(INPUT_POST, 'email');
      $senha = filter_input(INPUT_POST, 'senha');

      $senha = md5($senha);

      $modeloAdmin = new Admin(null);

      $visaoAdmin = new VisaoAdmin();
      $msg = '';

      $data = $modeloAdmin->login($email);

      if ($data == null){
        echo "
          <script>
            window.location.href = 'http://localhost/HARDWARE171/'
            alert('Administrador não encontrado!!');
          </script>
        ";
      }
      else{
        if($data[0]['senha'] == $senha){
          $_SESSION['login'] = true;
          echo "
            <script>
              window.location.href = 'http://localhost/HARDWARE171/Usuario/ver'
            </script>
          ";
        }
        else{
          echo "
            <script>
              window.location.href = 'http://localhost/HARDWARE171/'
              alert('A senha digitada está errada!!');
            </script>
          ";
        }
      }

      $visaoAdmin->mensagem('Gerenciamento de Administradores', 'Cadastro de Administradores', $msg);
    }

  }
 ?>
