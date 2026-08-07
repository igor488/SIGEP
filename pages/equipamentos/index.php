<?php
$pesquisa = $_GET['pesquisa'] ?? "";
$tipo = $_GET['tipo'] ?? "";
$setor = $_GET['setor'] ?? "";
$status = $_GET['status'] ?? "";

$sql = "

SELECT

e.*,

t.nome tipo,

s.nome setor

FROM equipamentos e

INNER JOIN tipos t
ON t.id=e.tipo_id

LEFT JOIN setores s
ON s.id=e.setor_id

WHERE e.ativo=1

";

$params=[];

if($pesquisa!=""){

$sql.=" AND (

e.patrimonio LIKE ?

OR

e.numero_serie LIKE ?

OR

e.modelo LIKE ?

OR

e.marca LIKE ?

)";

$p="%".$pesquisa."%";

$params[]=$p;
$params[]=$p;
$params[]=$p;
$params[]=$p;

}

if($tipo!=""){

$sql.=" AND e.tipo_id=?";

$params[]=$tipo;

}

if($setor!=""){

$sql.=" AND e.setor_id=?";

$params[]=$setor;

}

if($status!=""){

$sql.=" AND e.status=?";

$params[]=$status;

}

$sql.=" ORDER BY e.patrimonio";

$stmt=$pdo->prepare($sql);

$stmt->execute($params);


include("../../config/auth.php");
include("../../config/conexao.php");

$sql = $pdo->query("
SELECT

e.*,

t.nome as tipo,

s.nome as setor

FROM equipamentos e

INNER JOIN tipos t
ON e.tipo_id=t.id

LEFT JOIN setores s
ON e.setor_id=s.id

WHERE e.ativo=1

ORDER BY e.patrimonio

");

?>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Equipamentos</h2>

<a href="novo.php" class="btn btn-primary">

Novo Equipamento

</a>

</div>

<table class="table table-striped table-bordered">

<thead class="table-dark">

<tr>

<th>Patrimônio</th>

<th>Tipo</th>

<th>Marca</th>

<th>Modelo</th>

<th>Setor</th>

<th>Status</th>

<th width="180">Ações</th>

</tr>

</thead>

<tbody>

<?php

foreach($stmt as $eq){

?>

<tr>

<td><?= $eq['patrimonio']; ?></td>

<td><?= $eq['tipo']; ?></td>

<td><?= $eq['marca']; ?></td>

<td><?= $eq['modelo']; ?></td>

<td><?= $eq['setor']; ?></td>

<td><?= $eq['status']; ?></td>

<td>

<a
href="visualizar.php?id=<?= $eq['id']; ?>"
class="btn btn-info btn-sm"
title="Visualizar">

<i class="fa-solid fa-eye"></i>

</a>

<a
href="editar.php?id=<?= $eq['id']; ?>"
class="btn btn-warning btn-sm"
title="Editar">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="excluir.php?id=<?= $eq['id']; ?>"
class="btn btn-danger btn-sm"
title="Excluir"
onclick="return confirm('Deseja realmente excluir este equipamento?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>
</tr>

<?php

}

?>

</tbody>

</table>

</div>