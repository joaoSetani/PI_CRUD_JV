<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Bravo - Categorias</title>

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
              <a href="criar_categoria.php" class="link">+ Nova Categoria</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Bravo4Fun - Categorias </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Categoria:
                        </th>
                        <th class="text-right">
                          Editar
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //CHAMADA DA CONEXÃO COM O BANCO DE DADOS::

                      include('APP/conexao.php');

                      //BUSCAR DA TABELA CATEGORIA, ID E NOME DA CATEGORIA.

                      $sql = 'SELECT CATEGORIA_ID, CATEGORIA_NOME FROM CATEGORIA';

                      //QUERY :: pedido, o que foi pedido irá retornar na variavel criada ($resposta), $resposta se torna os dados do pedido

                      $resposta = $pdo->query($sql);

                      /*
                      FECTH_ARRAY = significa que vai receber as infos em forma de arrar, e
                      MYSQLI_ASSOC = associaçao por palavra, ou seja vai buscar a palavra que eu digitar
                      */

                      /*
                      enquanto existir uma linha execute o comando,
                      criar linha na tabela e inserir em cada linha nome categoria e id
                      */

                      while ($linha = $resposta->fetch(PDO::FETCH_ASSOC)) {
                        echo " <tr>
                        <td> {$linha['CATEGORIA_NOME']}  </td> 
                        <td class='text-right'><a href='editar_categoria.php?id={$linha['CATEGORIA_ID']}'>Editar</a></td>
                        </tr>";
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