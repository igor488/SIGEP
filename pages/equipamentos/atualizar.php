<?php

include("../../config/auth.php");
include("../../config/conexao.php");

$id = $_POST['id'] ?? 0;

$tipo_id = $_POST['tipo_id'] ?? null;

$setor_id = !empty($_POST['setor_id'])
    ? $_POST['setor_id']
    : null;

$marca = trim($_POST['marca'] ?? '');

$modelo = trim($_POST['modelo'] ?? '');

$numero_serie = trim($_POST['numero_serie'] ?? '');

$processador = trim($_POST['processador'] ?? '');

$memoria = trim($_POST['memoria'] ?? '');

$armazenamento = trim($_POST['armazenamento'] ?? '');

$sistema_operacional = trim(
    $_POST['sistema_operacional'] ?? ''
);

$patrimonio_antigo = trim(
    $_POST['patrimonio_antigo'] ?? ''
);

$status = $_POST['status'] ?? 'Estoque';

$observacoes = trim(
    $_POST['observacoes'] ?? ''
);


// Verifica se o equipamento existe
$verifica = $pdo->prepare("
    SELECT patrimonio
    FROM equipamentos
    WHERE id = ?
    AND ativo = 1
");

$verifica->execute([$id]);

$equipamento = $verifica->fetch(PDO::FETCH_ASSOC);

if (!$equipamento) {

    die("Equipamento não encontrado.");

}


// Atualiza equipamento
$sql = $pdo->prepare("
    UPDATE equipamentos
    SET

        tipo_id = ?,
        setor_id = ?,
        marca = ?,
        modelo = ?,
        numero_serie = ?,
        processador = ?,
        memoria = ?,
        armazenamento = ?,
        sistema_operacional = ?,
        patrimonio_antigo = ?,
        status = ?,
        observacoes = ?

    WHERE id = ?
");

$sql->execute([

    $tipo_id,
    $setor_id,
    $marca,
    $modelo,
    $numero_serie,
    $processador,
    $memoria,
    $armazenamento,
    $sistema_operacional,
    $patrimonio_antigo,
    $status,
    $observacoes,
    $id

]);


// Registra alteração no histórico
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

    "Alteração",

    $_SESSION['usuario'],

    "Dados do equipamento {$equipamento['patrimonio']} foram alterados."

]);


header(
    "Location: visualizar.php?id=" . $id
);

exit;