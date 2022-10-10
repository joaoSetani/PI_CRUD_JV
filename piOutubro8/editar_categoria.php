<?php

$id = 0;
$nome = "";
$descricao = "";

if (isset($_GET["id"])) {
  $id = $_GET['id'];

  include('APP/conexao.php');

  $sql = 'SELECT CATEGORIA_ID, CATEGORIA_NOME, CATEGORIA_DESC FROM CATEGORIA WHERE CATEGORIA_ID = ' . $id;

  $resposta = $pdo->query($sql);

  if ($resposta) {
    $linha = $resposta->fetch(PDO::FETCH_ASSOC);

    $nome = $linha["CATEGORIA_NOME"];
    $descricao = $linha["CATEGORIA_DESC"];
  } else {

  }
} else {
  header("Location: categorias.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo - Admin</title>

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
                <h4 class="card-title">Editar Categoria: </h4>
              </div>
              <form method="post" action="APP/categoria_sql.php" id="salvar" class="form-horizontal" novalidate="novalidate">
                <input type="hidden" name="acao" value="editar" />
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="card-body ">
                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="nome">NOME :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" required="true">

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <label class="col-sm-2 col-form-label" for="descricao">DESCRIÇÃO :</label>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <textarea name="descricao" class="form-control" required="true" value="<?php echo $descricao; ?>"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-primary">SALVAR</button>
                  <a class="btn btn-danger" href="APP/categoria_sql.php?acao=deletar&id=<?php echo $id; ?>">REMOVER</a>
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