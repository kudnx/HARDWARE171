<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
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
    </style>
    <title><?php echo $titulo ?></title>
  </head>
  <body>
    <nav>
      <ul>
        <li>
          Usuários
          <ul>
            <li><a href="/HARDWARE171/Usuario/ver">Ver</a></li>
            <li><a href="/HARDWARE171/Usuario/digitar">Digitar</a></li>
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
      <?php echo $conteudo; ?>
    </article>

    <footer>
      <p>Rodapé</p>
    </footer>

  </body>
</html>
