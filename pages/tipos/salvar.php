<?php

include('../../config/conexao.php');

$nome = $_POST['nome'];

$prefixo = strtoupper($_POST['prefixo']);

$descricao = $_POST['descricao'];


$verifica = $pdo->prepare("

SELECT *

FROM tipos

WHERE prefixo = ?

");

$verifica->execute([$prefixo]);

if($verifica->rowCount() > 0){

    die("Já existe um tipo com esse prefixo.");

}

$sql = $pdo->prepare("



INSERT INTO tipos

(nome,prefixo,descricao)

VALUES

(?,?,?)

");

$sql->execute([

$nome,

$prefixo,

$descricao

]);

header("Location:index.php");