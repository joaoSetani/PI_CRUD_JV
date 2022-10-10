<?php

function buscarCategorias()
{
    include('conexao.php');

    $sql = 'SELECT CATEGORIA_ID, CATEGORIA_NOME FROM CATEGORIA';

    $stm = $pdo->prepare($sql);
    $stm->execute();

    $categorias = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $categorias;
}
