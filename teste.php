<?php

echo "Iniciando conexão...<br>";

try {

    $pdo = new PDO(
        "mysql:host=localhost;dbname=sigep;charset=utf8mb4",
        "igor",
        "@Salgado123"
    );

    echo "Conectado com sucesso!";

} catch (PDOException $e) {

    echo "Erro:<br>";
    echo $e->getMessage();

}