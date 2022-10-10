<?php
include('APP/conta_app.php');
$adms = listarAdm();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo4Fun - Contas</title>

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
              <a href="conta-form.php" class="link">+ Nova Conta</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Bravo4Fun - Contas: </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>EMAIL:</th>
                        <th>SENHA:</th>
                        <th class="text-right">Editar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($adms as $adm) {
                        echo '<tr>
                                    <td> ' . $adm['ADM_EMAIL'] . '</td>
                                    <td> ' . $adm['ADM_SENHA'] . '</td>
                                    <td class="text-right">
                                      <a href="conta-edit.php?edit=' . strval($adm['ADM_ID']) . '">Editar</a>
                                    </td>
                                  </tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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