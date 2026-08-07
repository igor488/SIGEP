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

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>

<?= $eq['patrimonio']; ?>

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<h5>Informações Gerais</h5>

<table class="table">

<tr>

<th>Tipo</th>

<td><?= $eq['tipo']; ?></td>

</tr>

<tr>

<th>Setor</th>

<td><?= $eq['setor'] ?: "Estoque"; ?></td>

</tr>

<tr>

<th>Status</th>

<td><?= $eq['status']; ?></td>

</tr>

<tr>

<th>Marca</th>

<td><?= $eq['marca']; ?></td>

</tr>

<tr>

<th>Modelo</th>

<td><?= $eq['modelo']; ?></td>

</tr>

<tr>

<th>Número de Série</th>

<td><?= $eq['numero_serie']; ?></td>

</tr>

</table>

</div>

<div class="col-md-6">

<h5>Hardware</h5>

<table class="table">

<tr>

<th>Processador</th>

<td><?= $eq['processador']; ?></td>

</tr>

<tr>

<th>Memória</th>

<td><?= $eq['memoria']; ?></td>

</tr>

<tr>

<th>Armazenamento</th>

<td><?= $eq['armazenamento']; ?></td>

</tr>

<tr>

<th>Sistema</th>

<td><?= $eq['sistema_operacional']; ?></td>

</tr>

<tr>

<th>Patrimônio Antigo</th>

<td><?= $eq['patrimonio_antigo']; ?></td>

</tr>

</table>

</div>

</div>

<hr>

<h5>Observações</h5>

<hr>

<h4>Histórico</h4>

<?php

$hist = $pdo->prepare("
SELECT *

FROM historico

WHERE equipamento_id=?

ORDER BY data_hora DESC
");

$hist->execute([$id]);

?>

<table class="table table-striped">

<thead>

<tr>

<th>Data</th>

<th>Ação</th>

<th>Usuário</th>

<th>Descrição</th>

</tr>

</thead>

<tbody>

<?php

foreach($hist as $h){

?>

<tr>

<td><?= date('d/m/Y H:i',strtotime($h['data_hora'])) ?></td>

<td><?= $h['acao'] ?></td>

<td><?= $h['usuario'] ?></td>

<td><?= $h['descricao'] ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="border rounded p-3 bg-light">

<?= nl2br(htmlspecialchars($eq['observacoes'])); ?>

</div>

</div>

</div>

</div>