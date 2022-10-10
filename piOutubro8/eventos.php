<?php

include('APP/evento_app.php');

$eventos = buscarEventos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo4Fun - Eventos</title>

  <!-- Adicionando head ao documento -->
  <?php include("layout/head.php") ?>
</head>

<body>
  <div class="wrapper ">
    <!-- Adicionando menu ao documento -->
    <?php include("layout/menu.php") ?>

    <div class="main-panel">
      <!-- Adicionando menu superior ao documento -->
      <?php include("layout/menu-superior.php") ?>

      <!-- Conteudo -->
      <div class="content">
        <div class="row">
          <div class="col-12 text-right">
            <div class="adicionar">
              <a href="evento-form.php" class="link">+ Novo Evento</a>
            </div>
          </div>
        </div>
        <div class="row">

          <?php

          foreach ($eventos as $evento) {
            echo '<div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-body ">
                  <div class="row">
                    <div class="col-12 col-md-12">
                      <div class="imagem">
                        <img src="' . $evento['IMAGEM_URL'] . '" />
                      </div>
                    </div>
                    <div class="col-12 col-md-12">
                      <div class="textos">
                        <p class="card-category">' . $evento['PRODUTO_NOME'] . '</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer ">
                  <hr>
                  <div class="stats">
                    <a href="evento-form.php?id=' . strval($evento['PRODUTO_ID']) . '">Editar</a>
                  </div>
                  <hr>
                  <div class="stats">
                    <a href="imagens.php?id=' . strval($evento['PRODUTO_ID']) . '">Ver imagens</a>
                  </div>
                </div>
              </div>
            </div>';
          }

          ?>



        </div>

      </div>

      <!-- Adicionando rodape ao documento -->
      <?php include("layout/rodape.php") ?>
    </div>
  </div>

  <!-- Adicionando javascript ao documento -->
  <?php include("layout/javascript.php") ?>

</body>

</html>