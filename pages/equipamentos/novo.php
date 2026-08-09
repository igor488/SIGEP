<?php
include("../../config/auth.php");
include("../../config/conexao.php");

try {
    // Tenta buscar os tipos ativos
    $tipos = $pdo->query("SELECT * FROM tipos ORDER BY nome");
    $setores = $pdo->query("SELECT * FROM setores ORDER BY nome");
} catch(PDOException $e) {
    // Se der erro, tenta sem o filtro
    $tipos = $pdo->query("SELECT * FROM tipos ORDER BY nome");
    $setores = $pdo->query("SELECT * FROM setores ORDER BY nome");
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Novo Equipamento</h2>
        </div>
        <div class="card-body">
            <form action="salvar.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tipo *</label>
                            <select name="tipo_id" class="form-select" required>
                                <option value="">Selecione</option>
                                <?php foreach($tipos as $t): ?>
                                <option value="<?= $t['id'] ?>">
                                    <?= htmlspecialchars($t['nome']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Setor</label>
                            <select name="setor_id" class="form-select">
                                <option value="">Estoque</option>
                                <?php foreach($setores as $s): ?>
                                <option value="<?= $s['id'] ?>">
                                    <?= htmlspecialchars($s['nome']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <input type="text" name="marca" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Modelo</label>
                            <input type="text" name="modelo" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Número de Série</label>
                            <input type="text" name="numero_serie" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Patrimônio</label>
                            <input type="text" name="patrimonio" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Processador</label>
                            <input type="text" name="processador" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Memória RAM</label>
                            <input type="text" name="memoria" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Armazenamento</label>
                            <input type="text" name="armazenamento" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sistema Operacional</label>
                    <input type="text" name="sistema_operacional" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Cadastrar Equipamento
                </button>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </a>
            </form>
        </div>
    </div>
</div>