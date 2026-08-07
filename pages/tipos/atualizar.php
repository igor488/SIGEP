<?php

include("../../config/conexao.php");

$id = $_POST['id'];

$nome = $_POST['nome'];

$prefixo = strtoupper($_POST['prefixo']);

$descricao = $_POST['descricao'];

$verifica = $pdo->prepare("

SELECT *

FROM tipos

WHERE prefixo = ?

AND id <> ?

");

$verifica->execute([

$prefixo,

$id

]);

if($verifica->rowCount() > 0){

    die("Prefixo já utilizado.");

}

$sql = $pdo->prepare("


UPDATE tipos

SET

nome = ?,

prefixo = ?,

descricao = ?

WHERE id = ?

");

$sql->execute([

$nome,

$prefixo,

$descricao,

$id

]);

header("Location:index.php");

