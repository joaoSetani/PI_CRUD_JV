<?php
//conectar com o Banco de Dados

include('conexao.php');

/*

isset =  testagem de parametro
se existir o parametro, entre em um dos casos.


*/
if (isset($_POST["acao"])) {
    switch ($_POST['acao']) {
            //se o parametro for criar, efetuar a insert no banco de dados::
        case 'criar':
            $nome = $_POST['nome'];
            $desc = $_POST['descricao'];

            $sql = "INSERT INTO CATEGORIA (CATEGORIA_NOME, CATEGORIA_DESC) VALUES ( '{$nome}', '{$desc}');";

            $id = $pdo->query($sql);
           //redirecionamento para a pagina principal::
            header("Location: ../index.php");
            exit();

            break;

            //se o parametro for editar, efetuar o update no banco de dados::
        case 'editar':
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $desc = $_POST['descricao'];

            $sql = "UPDATE CATEGORIA SET CATEGORIA_NOME = '{$nome}', CATEGORIA_DESC = '{$desc}' WHERE CATEGORIA_ID = '{$id}';";

            $id = $pdo->query($sql);

            //redirecionamento para a pagina principal::
            header("Location: ../categorias.php");
            exit();

            break;

            //se o parametro for deletar, efetuar o delet no banco de dados::
    }
}
