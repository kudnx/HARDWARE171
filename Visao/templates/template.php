<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
  <script src="http://localhost/HARDWARE171/Script/jquery-3.5.1.js" type="text/JavaScript"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
  <script>
    $(document).ready(function() {
      $("#produto").change(function() {
        var produto_id = $(this).val();
        $.ajax({
          url: "/HARDWARE171/Venda/quantidade",
          method: "POST",
          data: {
            produto_id: produto_id
          },
          success: function(data) {
            data = parseInt(data);
            document.getElementById("quantidade").setAttribute("max", data);
          },
          error: function(error) {
            alert(error);
          }
        });
      });

    });
  </script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
  

  <style>
    body,
    nav {
      margin: 0;
      padding: 0;
      background-color: white;
      color: black;

    }



    ul {
      display: flex;
      justify-content: center;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    ul li ul {
      display: none;
      position: absolute;
    }

    ul li:hover ul {
      display: block;
    }

    li {
      padding: 15px;
      cursor: pointer;
      color:white;
     
    }

    li li {
      margin-left: -15px;
      background-color: rgba(50, 50, 50, 0.3);
    }



    a {
      text-decoration: none;
      color: inherit;
    }

    header {
      text-align: center;
    }

    section {
      text-align: center;
    }

    article {
      text-align: center;
    }



    footer {
      text-align: center;
    }

    teste {
      color: blue;
    }

    .Produto {
    display: flex;
    flex-wrap: wrap;
    margin: 0 auto;
  }
  .descricaoProduto {
    width: 50%;
  }

  .imagemProduto {
    width: 50%;
  }

  .ctaProduto{
    width:100%;
    margin-bottom: 30px;
  }



  button{
    margin:5px
  }

  </style>
  <title><?php echo $titulo ?></title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">


  <div class="collapse navbar-collapse  justify-content-center align-items-center" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          CLIENTES
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/HARDWARE171/cliente/ver">Listar</a>
          <a class="dropdown-item" href="/HARDWARE171/cliente/digitar">Cadastrar</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          FORNECEDORES
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/HARDWARE171/Fornecedor/ver">Listar</a>
          <a class="dropdown-item" href="/HARDWARE171/Fornecedor/digitar">Cadastrar</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          PRODUTOS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/HARDWARE171/Produto/ver">Listar</a>
          <a class="dropdown-item" href="/HARDWARE171/Produto/digitar">Cadastrar</a>
        </div>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          COMPRAS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/HARDWARE171/Compra/ver">Listar</a>
          <a class="dropdown-item" href="/HARDWARE171/Compra/nova">Nova</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          VENDAS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/HARDWARE171/Venda/ver">Listar</a>
          <a class="dropdown-item" href="/HARDWARE171/Venda/nova">Nova</a>
        </div>
      </li>

      
      <li class="   nav-item dropdown   justify-content-center align-items-end ">
      
        <a class="nav-link dropdown-toggle btn  btn btn-outline-secondary" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
          
          ADMINISTRADOR
          </a>
          
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/HARDWARE171/Admin/ver">Ver</a>
            <a class="dropdown-item" href="/HARDWARE171/Admin/digitar">Cadastrar</a>
            <a class="dropdown-item" href="/HARDWARE171/Admin/sair">Sair</a>
          </div>
       
        </li>
        
        





    </ul>
   
  </div>
</nav>


  
    <header>

      <h1><?php echo $titulo; ?></h1>
    </header>
    <section>
      <h2><?php echo $subtitulo; ?></h2>
    </section>


    <article class="article-content">
   
      <?php      
      echo  $conteudo;      
      ?>
      
    </article>  
    <img src="templates/img/logo.svg" alt="">


  <footer>
    <p style="color:#ced4da;">Copyright © 2020 | Luan Rangel, Heron Lima, Victor Alves e Waisman Braga</p>
  </footer>

</body>

</html>