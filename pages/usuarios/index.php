<?php

include("../../config/conexao.php");

$sql = $pdo->query("
SELECT *
FROM usuarios
WHERE ativo = 1
ORDER BY nome
");

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Usuários</h2>

        <a href="novo.php" class="btn btn-primary">

            <i class="fa-solid fa-user-plus"></i>

            Novo Usuário

        </a>

    </div>

    <table class="table table-bordered table-hover align-middle">

        <thead class="table-dark">

            <tr>

                <th width="70">ID</th>

                <th>Nome</th>

                <th>Email</th>

                <th width="150">Nível</th>

                <th width="100">Status</th>

                <th width="180">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($sql as $usuario){ ?>

            <tr>

                <td><?= $usuario['id']; ?></td>

                <td><?= htmlspecialchars($usuario['nome']); ?></td>

                <td><?= htmlspecialchars($usuario['email']); ?></td>

                <td>

                    <?php

                    switch($usuario['nivel']){

                        case 'Administrador':
                            echo "<span class='badge bg-danger'>Administrador</span>";
                            break;

                        case 'TI':
                            echo "<span class='badge bg-primary'>TI</span>";
                            break;

                        default:
                            echo "<span class='badge bg-secondary'>Consulta</span>";

                    }

                    ?>

                </td>

                <td>

                    <span class="badge bg-success">

                        Ativo

                    </span>

                </td>

                <td>

                    <a
                    href="editar.php?id=<?= $usuario['id']; ?>"
                    class="btn btn-warning btn-sm">

                        <i class="fa-solid fa-pen"></i>

                    </a>

                    <a
                    href="excluir.php?id=<?= $usuario['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Deseja realmente desativar este usuário?')">

                        <i class="fa-solid fa-trash"></i>

                    </a>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>