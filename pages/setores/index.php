<?php
include("../../config/auth.php");
include("../../config/conexao.php");

// Removendo o filtro WHERE ativo=1 que não existe
$sql = $pdo->query("SELECT * FROM setores ORDER BY nome");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Setores</h2>
        <a href="novo.php" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Novo Setor
        </a>
    </div>

    <?php if(isset($_GET['sucesso'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Operação realizada com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th width="180">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if($sql->rowCount() > 0): ?>
                    <?php foreach($sql as $setor): ?>
                    <tr>
                        <td><?= htmlspecialchars($setor['id']) ?></td>
                        <td><?= htmlspecialchars($setor['nome']) ?></td>
                        <td><?= htmlspecialchars($setor['descricao'] ?? '') ?></td>
                        <td>
                            <a href="visualizar.php?id=<?= $setor['id'] ?>" 
                               class="btn btn-info btn-sm" 
                               title="Visualizar">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="editar.php?id=<?= $setor['id'] ?>" 
                               class="btn btn-warning btn-sm" 
                               title="Editar">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="excluir.php?id=<?= $setor['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Deseja realmente excluir este setor?')"
                               title="Excluir">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum setor cadastrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>