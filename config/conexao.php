<?php

$host = "127.0.0.1";
$porta = "8080";
$banco = "sigep";
$usuario = "root";
$senha = "";

try {

    $pdo = new PDO(
        "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão realizada com sucesso!";

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());

}