<?php

$host = "127.0.0.1:3406";
$banco = "sigep";
$usuario = "admin.igor";
$senha = "@Salgado123";

try{

    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

    die("Erro: ".$e->getMessage());

}