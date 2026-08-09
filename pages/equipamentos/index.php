<?php
// 1. PRIMEIRO: Incluir os arquivos de configuração
include("../../config/auth.php");
include("../../config/conexao.php");

// 2. SEGUNDO: Pegar os filtros da URL
$pesquisa = $_GET['pesquisa'] ?? "";
$tipo = $_GET['tipo'] ?? "";
$setor = $_GET['setor'] ?? "";
$status = $_GET['status'] ?? "";

// 3. TERCEIRO: Construir a consulta SQL
$sql = "
SELECT
    e.*,
    t.nome as tipo,
    s.nome as setor
FROM equipamentos e
INNER JOIN tipos t ON t.id = e.tipo_id
LEFT JOIN setores s ON s.id = e.setor_id
WHERE e.ativo = 1
";

$params = [];

// Aplicar filtros
if($pesquisa != "") {
    $sql .= " AND (
        e.patrimonio LIKE ? OR
        e.numero_serie LIKE ? OR
        e.modelo LIKE ? OR
        e.marca LIKE ?
    )";
    $p = "%" . $pesquisa . "%";
    $params[] = $p;
    $params[] = $p;
    $params[] = $p;
    $params[] = $p;
}

if($tipo != "") {
    $sql .= " AND e.tipo_id = ?";
    $params[] = $tipo;
}

if($setor != "") {
    $sql .= " AND e.setor_id = ?";
    $params[] = $setor;
}

if($status != "") {
    $sql .= " AND e.status = ?";
    $params[] = $status;
}

$sql .= " ORDER BY e.patrimonio";

// 4. QUARTO: Executar a consulta
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Equipamentos</h2>
        <a href="novo.php" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Novo Equipamento
        </a>
    </div>

    <!-- Filtros (opcional) -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" 
                           name="pesquisa" 
                           class="form-control" 
                           placeholder="Pesquisar..." 
                           value="<?= htmlspecialchars($pesquisa) ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" 
                           name="tipo" 
                           class="form-control" 
                           placeholder="Tipo" 
                           value="<?= htmlspecialchars($tipo) ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" 
                           name="setor" 
                           class="form-control" 
                           placeholder="Setor" 
                           value="<?= htmlspecialchars($setor) ?>">
                </div>
                <div class="col-md-2">
                    <input type="text" 
                           name="status" 
                           class="form-control" 
                           placeholder="Status" 
                           value="<?= htmlspecialchars($status) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-search"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
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
                <?php if($stmt->rowCount() > 0): ?>
                    <?php foreach($stmt as $eq): ?>
                    <tr>
                        <td><?= htmlspecialchars($eq['patrimonio']) ?></td>
                        <td><?= htmlspecialchars($eq['tipo']) ?></td>
                        <td><?= htmlspecialchars($eq['marca']) ?></td>
                        <td><?= htmlspecialchars($eq['modelo']) ?></td>
                        <td><?= htmlspecialchars($eq['setor']) ?></td>
                        <td>
                            <span class="badge <?= $eq['status'] == 'Ativo' ? 'bg-success' : 'bg-danger' ?>">
                                <?= htmlspecialchars($eq['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="visualizar.php?id=<?= $eq['id'] ?>" 
                               class="btn btn-info btn-sm" 
                               title="Visualizar">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="editar.php?id=<?= $eq['id'] ?>" 
                               class="btn btn-warning btn-sm" 
                               title="Editar">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="excluir.php?id=<?= $eq['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Deseja realmente desativar este equipamento?')"
                               title="Excluir">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhum equipamento encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>