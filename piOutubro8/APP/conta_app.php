<?php

//IDENTIFICAR OQUE FAZER UTILIZANDO O POST

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'criar':

            criarAdm();
            break;
        case 'editar':

            editarAdm();
            break;
    }
}

function listarAdm()
{
    include('conexao.php');

    $sql = 'SELECT ADM_ID, ADM_EMAIL, ADM_SENHA FROM ADMINISTRADOR';

    //CONEXAO COM O BANCO 
    $stm = $pdo->prepare($sql);
    $stm->execute();

    //FECHT ASSOC SIGNIFICA :: ARRAY DE ASSOCIAÇAO

    $adm = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $adm;
}

function criarAdm()

{
    $admin = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'ativo' => isset($_POST['ativo']) ? boolval($_POST['ativo']) : false,
        'senha' => $_POST['senha']
    ];

    include('APP/conexao.php');

    $sql = 'INSERT INTO ADMINISTRADOR
            (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) 
            VALUES 
            (:ADM_NOME, :ADM_EMAIL, :ADM_SENHA, :ADM_ATIVO)';

    $stm = $pdo->prepare($sql);
    $stm->bindParam(":ADM_NOME", $admin['nome'], PDO::PARAM_STR);
    $stm->bindParam(":ADM_EMAIL", $admin['email'], PDO::PARAM_STR);
    $stm->bindParam(":ADM_SENHA", $admin['senha'], PDO::PARAM_STR);
    $stm->bindParam(":ADM_ATIVO", $admin['ativo'], PDO::PARAM_INT);
    //oq é bindParam :: troca de parametro por variavel

    $stm->execute();

    //redirecionamento para pagina contas
    header("Location: contas.php");
    die();
}

function editarAdm()
{
    $id = 0;
    //global $nome, $email,$senha;
    $nome = '';
    $email = '';
    $senha = '';


    if (isset($_GET["edit"])) {
        $id = $_GET['edit'];
        
        include('APP/conexao.php');

        $sql = 'SELECT ADM_ID, ADM_NOME, ADM_SENHA, ADM_ATIVO FROM ADMINISTRADOR WHERE ADM_ID = ' . $id;

    $resposta = $pdo->query($sql);

    if ($resposta) {
        $row = $resposta->fetch(PDO::FETCH_ASSOC);
        
        $nome = $row["ADM_NOME"];
        $email = $row["ADM_EMAIL"];
        $senha = $row["ADM_SENHA"];

    } else {

    }
    } else {
    header("Location: contas.php");
    exit();
    }
    
    /*
    function updateAdm(){
        $sql = "UPDATE ADMINISTRADOR SET ADM_NOME = :ADM_NOME, 
            ADM_EMAIL = :ADM_EMAIL, 
            ADM_SENHA = :ADM_SENHA,   
            WHERE ADM_ID = :ADM_ID";

        include('APP/conexao.php');

        $stmt = $pdo->prepare($sql); 

        $stmt->bindParam(':ADM_NOME', $_POST['nome'], PDO::PARAM_STR);       
        $stmt->bindParam(':ADM_EMAIL', $_POST['email'], PDO::PARAM_STR);    
        $stmt->bindParam(':ADM_SENHA', $_POST['senha'], PDO::PARAM_STR);
        // use PARAM_STR although a number    
        $stmt->bindParam(':ADM_ID', $_POST['id'], PDO::PARAM_INT);   
        $stmt->execute(); 
        
        header('Location: contas.php');


    }*/
    
}
