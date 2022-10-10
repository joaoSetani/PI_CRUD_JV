<?php
include('APP/conta_app.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo4Fun - Conta</title>

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
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">Criar conta: </h4>
              </div>
              <form method="post" action="conta-form.php" id="salvar" class="form-horizontal" novalidate="novalidate">
                <input type="hidden" name="acao" value="criar" />
                <input type="hidden" name="id" value="0" />
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="ativo" <?php if (isset($conta)) {
                                                                                          echo $conta['PRODUTO_ATIVO'] ? 'checked' : '';
                                                                                        } else {
                                                                                          echo 'checked';
                                                                                        } ?>>
                          <span class="form-check-sign"></span>
                          CONTA ATIVA
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="nome">NOME:</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" name="nome" class="form-control" required="true">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="nome">EMAIL:</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="email" name="email" class="form-control" required="true">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="nome">SENHA:</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="password" name="senha" class="form-control" required="true">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
              </form>
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
  <script>
    $("#salvar").validate({});

    jQuery.extend(jQuery.validator.messages, {
      required: "Campo Obrigatório",
      email: "Escreva um email valido",
      number: "Escreva um valor válido"
    });
  </script>
</body>

</html>