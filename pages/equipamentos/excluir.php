<?php

include("../../config/auth.php");
include("../../config/conexao.php");

$id = $_GET['id'] ?? 0;

if (!$id) {
    die("Equipamento inválido.");
}


// Busca o equipamento
$sql = $pdo->prepare("
    SELECT patrimonio
    FROM equipamentos
    WHERE id = ?
    AND ativo = 1
");

$sql->execute([$id]);

$equipamento = $sql->fetch(PDO::FETCH_ASSOC);

if (!$equipamento) {
    die("Equipamento não encontrado ou já está inativo.");
}


// Exclusão lógica
$update = $pdo->prepare("
    UPDATE equipamentos
    SET ativo = 0
    WHERE id = ?
");

$update->execute([$id]);


// Registra no histórico
$historico = $pdo->prepare("
    INSERT INTO historico
    (
        equipamento_id,
        acao,
        usuario,
        descricao
    )
    VALUES (?, ?, ?, ?)
");

$historico->execute([

    $id,

    "Exclusão",

    $_SESSION['usuario'],

    "Equipamento {$equipamento['patrimonio']} foi desativado."

]);


header("Location: index.php");

exit;