<?php

include('../../config/conexao.php');

$sql = $pdo->query("

SELECT *

FROM tipos

WHERE ativo = 1

ORDER BY nome

");

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">

        <h2>Tipos de Equipamentos</h2>

        <a href="novo.php" class="btn btn-primary">

            <i class="fa fa-plus"></i>

            Novo Tipo

        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>

                <th>ID</th>

                <th>Nome</th>

                <th>Prefixo</th>

                <th>Status</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

<?php

foreach($sql as $tipo){

?>

<tr>

<td><?= $tipo['id']; ?></td>

<td><?= $tipo['nome']; ?></td>

<td><?= $tipo['prefixo']; ?></td>

<td>

<?php

echo $tipo['ativo']
? "<span class='badge bg-success'>Ativo</span>"
: "<span class='badge bg-danger'>Inativo</span>";

?>

</td>

<td>

<a href="editar.php?id=<?= $tipo['id']; ?>" class="btn btn-warning btn-sm">

Editar

<a

href="excluir.php?id=<?= $tipo['id']; ?>"

class="btn btn-danger btn-sm"

onclick="return confirm('Deseja realmente desativar este tipo?')"

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