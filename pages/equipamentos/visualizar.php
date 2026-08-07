<?php

include("../../config/auth.php");
include("../../config/conexao.php");

$id = $_GET['id'] ?? 0;

$sql = $pdo->prepare("
SELECT

e.*,

t.nome tipo,

t.prefixo,

s.nome setor

FROM equipamentos e

INNER JOIN tipos t
ON t.id=e.tipo_id

LEFT JOIN setores s
ON s.id=e.setor_id

WHERE e.id=?
");

$sql->execute([$id]);

$eq = $sql->fetch(PDO::FETCH_ASSOC);

if(!$eq){

die("Equipamento não encontrado.");

}

?>