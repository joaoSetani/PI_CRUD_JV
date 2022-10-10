<?php

include("APP/login_app.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Bravo4Fun - Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Bravo4Fun Login:</h4>
              </div>

              <div class="card-body">
                <div>
                  <form action="login.php" method="post">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    </div>
                    <div class="form-group">
                      <div class="d-block">
                        <label for="senha" class="control-label">Senha</label>
                      </div>
                      <input id="senha" type="password" class="form-control" name="senha" tabindex="2" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" id="entrar" class="btn btn-primary btn-lg btn-block" tabindex="4">Entrar</button>
                    </div>

                    <?php

                    if (isset($loginErro) && !empty($loginErro)) {
                      echo $loginErro;
                    }

                    ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>