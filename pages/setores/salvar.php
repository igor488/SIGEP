<?php

include("../../config/conexao.php");

$nome = trim($_POST['nome']);
$responsavel = trim($_POST['responsavel']);
$localizacao = trim($_POST['localizacao']);
$descricao = trim($_POST['descricao']);

$verifica = $pdo->prepare("

SELECT id

FROM setores

WHERE nome = ?

AND ativo = 1

");

$verifica->execute([$nome]);

if($verifica->rowCount() > 0){

die("Já existe um setor com esse nome.");

}

$sql = $pdo->prepare("

INSERT INTO setores

(nome,responsavel,localizacao,descricao)

VALUES

(?,?,?,?)

");

$sql->execute([

$nome,

$responsavel,

$localizacao,

$descricao

]);

header("Location:index.php");