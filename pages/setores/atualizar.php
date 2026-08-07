<?php

include("../../config/conexao.php");

$id = $_POST['id'];

$nome = trim($_POST['nome']);
$responsavel = trim($_POST['responsavel']);
$localizacao = trim($_POST['localizacao']);
$descricao = trim($_POST['descricao']);

$verifica = $pdo->prepare("

SELECT id

FROM setores

WHERE nome = ?

AND id <> ?

AND ativo = 1

");

$verifica->execute([$nome,$id]);

if($verifica->rowCount() > 0){

die("Já existe outro setor com esse nome.");

}

$sql = $pdo->prepare("

UPDATE setores

SET

nome=?,

responsavel=?,

localizacao=?,

descricao=?

WHERE id=?

");

$sql->execute([

$nome,

$responsavel,

$localizacao,

$descricao,

$id

]);

header("Location:index.php");