<?php

include("../../config/conexao.php");

$id = $_POST['id'];
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];

$verifica = $pdo->prepare("
SELECT id
FROM usuarios
WHERE email = ?
AND id <> ?
");

$verifica->execute([$email,$id]);

if($verifica->rowCount() > 0){

    die("Este e-mail já pertence a outro usuário.");

}

if(!empty($senha)){

    $senhaHash = password_hash($senha,PASSWORD_DEFAULT);

    $sql = $pdo->prepare("
    UPDATE usuarios
    SET
    nome=?,
    email=?,
    senha=?,
    nivel=?
    WHERE id=?
    ");

    $sql->execute([

        $nome,

        $email,

        $senhaHash,

        $nivel,

        $id

    ]);

}else{

    $sql = $pdo->prepare("
    UPDATE usuarios
    SET
    nome=?,
    email=?,
    nivel=?
    WHERE id=?
    ");

    $sql->execute([

        $nome,

        $email,

        $nivel,

        $id

    ]);

}

header("Location:index.php");