<?php

if (isset($_COOKIE["login"])) {
    include("APP/conexao.php");

    $email = $_COOKIE["login"];


    $stm = $pdo->prepare("SELECT ADM_EMAIL, ADM_SENHA FROM ADMINISTRADOR WHERE ADM_EMAIL = :ADM_EMAIL");
    $stm->bindParam(":ADM_EMAIL", $email, PDO::PARAM_STR);
    $stm->execute();

    $admin = $stm->fetch(PDO::FETCH_ASSOC);

    if ($admin) {

        $email_db = $admin['ADM_EMAIL'];
        if ($email_db != $email) {
            header("Location: /pi/login.php");
            die();
        }
    } else {
        header("Location: /pi/login.php");
        die();
    }
} else {
    header("Location: /pi/login.php");
    die();
}
