<?php

include("../../config/conexao.php");

$sql = $pdo->query("

SELECT *

FROM setores

WHERE ativo = 1

ORDER BY nome

");

?>

<div class="container mt-4">

<div class="d-flex justify-content-between mb-3">

<h2>Setores</h2>

<a href="novo.php" class="btn btn-primary">

<i class="fa fa-plus"></i>

Novo Setor

</a>

</div>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Nome</th>

<th>Responsável</th>

<th>Localização</th>

<th>Ações</th>

</tr>

</thead>

<tbody>

<?php

foreach($sql as $setor){

?>

<tr>

<td><?= $setor['id']; ?></td>

<td><?= $setor['nome']; ?></td>

<td><?= $setor['responsavel']; ?></td>

<td><?= $setor['localizacao']; ?></td>

<td>

<a

href="editar.php?id=<?= $setor['id']; ?>"

class="btn btn-warning btn-sm"

>

Editar

</a>

<a

href="excluir.php?id=<?= $setor['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Deseja desativar este setor?')"

>

Excluir

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>