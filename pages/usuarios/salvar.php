<?php

include("../../config/conexao.php");

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];
$nivel = $_POST['nivel'];

if($senha != $confirmar){

    die("As senhas não conferem.");

}

$verifica = $pdo->prepare("
SELECT id
FROM usuarios
WHERE email = ?
");

$verifica->execute([$email]);

if($verifica->rowCount() > 0){

    die("Este e-mail já está cadastrado.");

}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = $pdo->prepare("
INSERT INTO usuarios
(nome,email,senha,nivel)
VALUES
(?,?,?,?)
");

$sql->execute([

$nome,

$email,

$senhaHash,

$nivel

]);

header("Location:index.php");