<?php

include('APP/evento_app.php');
include('APP/categoria_app.php');
$categorias = buscarCategorias();

if (isset($_GET['id']) && $_GET['id'] > 0) {
  $evento = buscarEvento($_GET['id']);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo4Fun - Evento</title>

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
                <h4 class="card-title"><?php echo isset($_GET['id']) ? 'Editar' : 'Criar'; ?> Evento</h4>
              </div>
              <form method="post" action="evento-form.php" id="salvar" class="form-horizontal" novalidate="novalidate">
                <input type="hidden" name="acao" value="<?php echo isset($_GET['id']) ? 'editar' : 'criar'; ?>" />
                <input type="hidden" name="id" value="<?php echo isset($evento) ? $evento['PRODUTO_ID'] : 0 ?>" />
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-10 checkbox-radios">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="ativo" <?php if (isset($evento)) {
                                                                                          echo $evento['PRODUTO_ATIVO'] ? 'checked' : '';
                                                                                        } else {
                                                                                          echo 'checked';
                                                                                        } ?>>
                          <span class="form-check-sign"></span>
                          PRODUTO ATIVO
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="nome">NOME :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" name="nome" class="form-control" required="true" value="<?php echo isset($evento) ? $evento['PRODUTO_NOME'] : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="preco">PREÇO :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="number" name="preco" step="0.01" class="form-control" required="true" value="<?php echo isset($evento) ? $evento['PRODUTO_PRECO'] : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="qtd">QUANTIDADE :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="number" name="qtd" class="form-control" required="true" value="<?php echo isset($evento) ? $evento['PRODUTO_QTD'] : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="desconto">DESCONTO :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="number" name="desconto" class="form-control" required="true" value="<?php echo isset($evento) ? $evento['PRODUTO_DESCONTO'] : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="categoria">CATEGORIA :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <select name="categoria_id" class="form-control" required="true">
                          <?php

                          if (isset($categorias)) {
                            foreach ($categorias as $categoria) {
                              echo '<option value="' . strval($categoria['CATEGORIA_ID']) . '">' . $categoria['CATEGORIA_NOME'] . '</option>';
                            }
                          }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="imagem">IMAGEM :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" name="url" class="form-control" required="true" value="<?php echo isset($evento) ? $evento['IMAGEM_URL'] : '' ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="desc">DESCRIÇÃO :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <textarea name="desc" class="form-control" required="true"><?php echo isset($evento) ? $evento['PRODUTO_DESC'] : '' ?></textarea>
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