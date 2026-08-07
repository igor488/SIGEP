<?php

include("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("

UPDATE setores

SET ativo = 0

WHERE id = ?

");

$sql->execute([$id]);

header("Location:index.php");