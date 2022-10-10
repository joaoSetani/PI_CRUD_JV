<?php
include("APP/conexao.php");

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Utilizando REGEX para validar email - https://acervolima.com/como-validar-um-e-mail-usando-php/
    //$pattern = "/^[a-z0-9.]+@[a-z0-9]+\.[a-z]+\.([a-z]+)?$/i";
    //if (preg_match($pattern, $email)) {

    $stm = $pdo->prepare("SELECT ADM_EMAIL, ADM_SENHA FROM ADMINISTRADOR WHERE ADM_EMAIL = :ADM_EMAIL");
    $stm->bindParam(":ADM_EMAIL", $email, PDO::PARAM_STR);
    $stm->execute();

    $admin = $stm->fetch(PDO::FETCH_ASSOC);

    if ($admin) {

        if ($senha == $admin['ADM_SENHA']) {
            $email_db = $admin['ADM_EMAIL'];

            setcookie("login", $email_db, time() + (86400 * 30), "/"); // 86400 = 1 day
            header("Location: /piOutubro8/piOutubro8/index.php");
            die();
        } else {
            $loginErro =  '<div class="form-group"><span style="color: #F00">Email ou senha invalido, tente novamente</span></div>';
        }
    } else {
        $loginErro =  '<div class="form-group"><span style="color: #F00">Email ou senha invalido, tente novamente</span></div>';
    }
    //}
}

if (isset($_COOKIE["login"])) {

    $email = $_COOKIE["login"];

    /* $admin = $pdo->query("SELECT ADM_EMAIL FROM administador WHERE ADM_EMAIL = '" .  $email . "'")->fetch(PDO::FETCH_ASSOC);
    if ($admin) {
        $email_db = $admin['ADM_EMAIL'];

        if ($email_db == $email) {
            header("Location: pi/index.php");
            die();
        }
    }*/
}


//