<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
  <script src="http://localhost/HARDWARE171/Script/jquery-3.5.1.js" type="text/JavaScript"></script>

  <script>

  $(document).ready(function(){
    $("#produto").change(function(){  
      var produto_id = $(this).val();
      $.ajax({  
          url:"/HARDWARE171/Venda/quantidade",  
          method:"POST", 
          data:{produto_id:produto_id},
          success:function(data){
            data = parseInt(data);
            document.getElementById("quantidade").setAttribute("max", data);
          },
          error: function(error){
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
        background-color: teal;
        color: wheat;
      }

      nav{
        background-color: black;
      }

      ul{
        display: flex;
        justify-content: center;
        list-style: none;
        margin: 0;
        padding: 0;
      }

      ul li ul{
        display: none;
        position: absolute;
      }

      ul li:hover ul {
        display: block;
      }

      li{
        padding: 15px;
        cursor: pointer;
        background-color: rgba(50, 50, 50, 0.3);
      }

      li li {
        margin-left: -15px;
      }

      li:hover{
        background-color: rgba(50, 50, 50, 0.7);
      }

      a{
        text-decoration: none;
        color: inherit;
      }

      header{
        text-align: center;
      }

      section{
        text-align: center;
      }

      article{
        text-align: center;
      }

      footer{
        text-align: center;
      }

    </style>
    <title><?php echo $titulo ?></title>
  </head>
  <body>
    <nav>
      <ul>
        <li>
          Clientes
          <ul>
            <li><a href="/HARDWARE171/cliente/ver">Ver</a></li>
            <li><a href="/HARDWARE171/cliente/digitar">Digitar</a></li>
          </ul>
        </li>
        <li>
          Fornecedores
          <ul>
            <li><a href="/HARDWARE171/Fornecedor/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Fornecedor/digitar">Digitar</a></li>
          </ul>
        </li>
        <li>
          Produtos
          <ul>
            <li><a href="/HARDWARE171/Produto/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Produto/digitar">Digitar</a></li>
          </ul>
        </li>
        <li>
          Admin
          <ul>
            <li><a href="/HARDWARE171/Admin/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Admin/digitar">Digitar</a></li>
            <li><a href="/HARDWARE171/Admin/sair">Sair</a></li>
          </ul>
        </li>
        <li>
          Compra
          <ul>
            <li><a href="/HARDWARE171/Compra/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Compra/nova">Nova</a></li>
          </ul>
        </li>
        <li>
          Venda
          <ul>
            <li><a href="/HARDWARE171/Venda/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Venda/nova">Nova</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <header>
      <h1><?php echo $titulo; ?></h1>
    </header>
    <section>
      <h2><?php echo $subtitulo; ?></h2>
    </section>
    <article class="">
      <?php
       echo $conteudo;
      ?>
    </article>

    <footer>
      <p>Rodapé</p>
    </footer>

  </body>
</html>
