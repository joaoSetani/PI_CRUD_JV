<?php

//IDENTIFICAR OQUE FAZER UTILIZANDO O POST
if (isset($_POST['acao'])) {

    switch ($_POST['acao']) {
        case 'criar':

            criarEvento();
            break;
        case 'editar':

            editarEvento();
            break;
    }
}

function buscarEventos()
{
    include('APP/conexao.php');

    $sql = 'SELECT PRODUTO.PRODUTO_ID, PRODUTO.PRODUTO_NOME, PRODUTO_IMAGEM.IMAGEM_URL FROM PRODUTO
    LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
    WHERE PRODUTO_IMAGEM.IMAGEM_ORDEM = 0;';

    $stm = $pdo->prepare($sql);
    $stm->execute();

    $produtos = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $produtos;
}

function buscarEvento($produto_id)
{
    include('APP/conexao.php');

    $sql = 'SELECT PRODUTO.PRODUTO_ID, PRODUTO.PRODUTO_NOME, PRODUTO.PRODUTO_DESC, PRODUTO.PRODUTO_PRECO, PRODUTO.PRODUTO_DESCONTO, PRODUTO.CATEGORIA_ID, PRODUTO.PRODUTO_ATIVO, PRODUTO_IMAGEM.IMAGEM_URL, PRODUTO_ESTOQUE.PRODUTO_QTD
        FROM PRODUTO
        LEFT JOIN PRODUTO_IMAGEM ON PRODUTO.PRODUTO_ID = PRODUTO_IMAGEM.PRODUTO_ID
        LEFT JOIN PRODUTO_ESTOQUE ON PRODUTO.PRODUTO_ID = PRODUTO_ESTOQUE.PRODUTO_ID
        WHERE PRODUTO.PRODUTO_ID = :PRODUTO_ID AND PRODUTO_IMAGEM.IMAGEM_ORDEM = 0';

    $stm = $pdo->prepare($sql);
    $stm->bindParam(":PRODUTO_ID", $produto_id, PDO::PARAM_INT);
    $stm->execute();

    $produto = $stm->fetch(PDO::FETCH_ASSOC);

    return $produto;
}

function criarEvento()
{
    $produto = [
        'nome' => $_POST['nome'],
        'desc' => $_POST['desc'],
        'preco' => $_POST['preco'],
        'desconto' => $_POST['desconto'],
        'qtd' => $_POST['qtd'],
        'categoria_id' => $_POST['categoria_id'],
        'ativo' => isset($_POST['ativo']) ? boolval($_POST['ativo']) : false,
        'url' => $_POST['url']
    ];

    include('APP/conexao.php');

    $sql = 'INSERT INTO PRODUTO
        ( PRODUTO_NOME, PRODUTO_DESC, PRODUTO_PRECO, PRODUTO_DESCONTO, CATEGORIA_ID, PRODUTO_ATIVO) 
        VALUES 
        ( :PRODUTO_NOME, :PRODUTO_DESC, :PRODUTO_PRECO, :PRODUTO_DESCONTO, :CATEGORIA_ID, :PRODUTO_ATIVO)';

    $stm = $pdo->prepare($sql);
    $stm->bindParam(":PRODUTO_NOME", $produto['nome'], PDO::PARAM_STR);
    $stm->bindParam(":PRODUTO_DESC", $produto['desc'], PDO::PARAM_STR);
    $stm->bindParam(":PRODUTO_PRECO", $produto['preco'], PDO::PARAM_STR);
    $stm->bindParam(":PRODUTO_DESCONTO", $produto['desconto'], PDO::PARAM_STR);
    $stm->bindParam(":CATEGORIA_ID", $produto['categoria_id'], PDO::PARAM_INT);
    $stm->bindParam(":PRODUTO_ATIVO", $produto['ativo'], PDO::PARAM_INT);

    $stm->execute();

    //RECUPERANDO O ID DO PRODUTO QUE INSERIMOS NO DB 
    $produto_id = $pdo->lastInsertId();

    //INSERT PRODUTO_QUANTIDADE
    $sql = 'INSERT INTO PRODUTO_ESTOQUE
        ( PRODUTO_ID, PRODUTO_QTD) 
        VALUES 
        ( :PRODUTO_ID, :PRODUTO_QTD)';

    $stm = $pdo->prepare($sql);
    $stm->bindParam(":PRODUTO_ID", $produto_id, PDO::PARAM_INT);
    $stm->bindParam(":PRODUTO_QTD", $produto['qtd'], PDO::PARAM_INT);

    $stm->execute();

    //INSERT PRODUTO_IMAGEM PRINCIPAL
    $sql = 'INSERT INTO PRODUTO_IMAGEM
        ( IMAGEM_ORDEM, IMAGEM_URL, PRODUTO_ID ) 
        VALUES 
        ( 0, :IMAGEM_URL, :PRODUTO_ID )';

    $stm = $pdo->prepare($sql);
    $stm->bindParam(":IMAGEM_URL", $produto['url'], PDO::PARAM_STR);
    $stm->bindParam(":PRODUTO_ID", $produto_id, PDO::PARAM_INT);

    $stm->execute();
    header("Location: ../pi/eventos.php");
}

function editarEvento()
{
    if ($_POST['id'] > 0) {
        $produto = [
            'id' => $_POST['id'],
            'nome' => $_POST['nome'],
            'desc' => $_POST['desc'],
            'preco' => $_POST['preco'],
            'desconto' => $_POST['desconto'],
            'qtd' => $_POST['qtd'],
            'categoria_id' => $_POST['categoria_id'],
            'ativo' => isset($_POST['ativo']) ? boolval($_POST['ativo']) : false,
            'url' => $_POST['url']
        ];

        include('APP/conexao.php');

        $sql = 'UPDATE PRODUTO 
        SET PRODUTO_NOME = :PRODUTO_NOME,
        PRODUTO_DESC = :PRODUTO_DESC,
        PRODUTO_PRECO = :PRODUTO_PRECO,
        PRODUTO_DESCONTO = :PRODUTO_DESCONTO,
        CATEGORIA_ID = :CATEGORIA_ID, PRODUTO_ATIVO = :PRODUTO_ATIVO 
        WHERE PRODUTO_ID = :PRODUTO_ID';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(":PRODUTO_NOME", $produto['nome'], PDO::PARAM_STR);
        $stm->bindParam(":PRODUTO_DESC", $produto['desc'], PDO::PARAM_STR);
        $stm->bindParam(":PRODUTO_PRECO", $produto['preco'], PDO::PARAM_STR);
        $stm->bindParam(":PRODUTO_DESCONTO", $produto['desconto'], PDO::PARAM_STR);
        $stm->bindParam(":CATEGORIA_ID", $produto['categoria_id'], PDO::PARAM_INT);
        $stm->bindParam(":PRODUTO_ATIVO", $produto['ativo'], PDO::PARAM_INT);
        $stm->bindParam(":PRODUTO_ID", $produto['id'], PDO::PARAM_INT);

        $stm->execute();

        //UPDATE PRODUTO_QUANTIDADE
        $sql = 'UPDATE PRODUTO_ESTOQUE
        SET PRODUTO_QTD = :PRODUTO_QTD
        WHERE PRODUTO_ID = :PRODUTO_ID';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(":PRODUTO_QTD", $produto['qtd'], PDO::PARAM_INT);
        $stm->bindParam(":PRODUTO_ID", $produto['id'], PDO::PARAM_INT);

        $stm->execute();

        //UPDATE PRODUTO_IMAGEM PRINCIPAL
        $sql = 'UPDATE PRODUTO_IMAGEM
        SET IMAGEM_ORDEM = :IMAGEM_ORDEM,
        IMAGEM_URL = :IMAGEM_URL
        WHERE PRODUTO_ID = :PRODUTO_ID';

        $orderImg = 0;

        $stm = $pdo->prepare($sql);
        $stm->bindParam(":IMAGEM_ORDEM", $orderImg , PDO::PARAM_INT);
        $stm->bindParam(":IMAGEM_URL", $produto['url'], PDO::PARAM_STR);
        $stm->bindParam(":PRODUTO_ID", $produto_id, PDO::PARAM_INT);

        $stm->execute();
        header("Location: ../pi/eventos.php");
    }
}
