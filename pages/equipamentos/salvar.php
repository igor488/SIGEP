<?php

include("../../config/auth.php");
include("../../config/conexao.php");
include("../../helpers/patrimonio.php");

// Recebe os dados do formulário
$tipo_id = $_POST['tipo_id'];
$setor_id = !empty($_POST['setor_id']) ? $_POST['setor_id'] : null;
$marca = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$numero_serie = trim($_POST['numero_serie']);
$processador = trim($_POST['processador']);
$memoria = trim($_POST['memoria']);
$armazenamento = trim($_POST['armazenamento']);
$sistema_operacional = trim($_POST['sistema_operacional']);
$patrimonio_antigo = trim($_POST['patrimonio_antigo']);
$observacoes = trim($_POST['observacoes']);

// Busca o prefixo do tipo
$sql = $pdo->prepare("
SELECT prefixo
FROM tipos
WHERE id = ?
");

$sql->execute([$tipo_id]);

$tipo = $sql->fetch(PDO::FETCH_ASSOC);

if(!$tipo){
    die("Tipo de equipamento não encontrado.");
}

// Gera patrimônio automático
$patrimonio = gerarPatrimonio($pdo, $tipo['prefixo']);

// Salva equipamento
$sql = $pdo->prepare("
INSERT INTO equipamentos(

patrimonio,
tipo_id,
setor_id,
marca,
modelo,
numero_serie,
processador,
memoria,
armazenamento,
sistema_operacional,
patrimonio_antigo,
observacoes

)

VALUES(

?,?,?,?,?,?,?,?,?,?,?,?

)
");

$sql->execute([

$patrimonio,
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
$observacoes

]);

$idEquipamento = $pdo->lastInsertId();

// Histórico
$sql = $pdo->prepare("
INSERT INTO historico(

equipamento_id,
acao,
usuario,
descricao

)

VALUES(

?,?,?,?

)
");

$sql->execute([

$idEquipamento,

"Cadastro",

$_SESSION['usuario'],

"Equipamento cadastrado no sistema."

]);

header("Location:index.php");
exit;