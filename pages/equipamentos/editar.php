<?php

include("../../config/auth.php");
include("../../config/conexao.php");

$id = $_GET['id'] ?? 0;

$sql = $pdo->prepare("
    SELECT *
    FROM equipamentos
    WHERE id = ?
    AND ativo = 1
");

$sql->execute([$id]);

$equipamento = $sql->fetch(PDO::FETCH_ASSOC);

if (!$equipamento) {
    die("Equipamento não encontrado.");
}

$tipos = $pdo->query("
    SELECT *
    FROM tipos
    WHERE ativo = 1
    ORDER BY nome
");

$setores = $pdo->query("
    SELECT *
    FROM setores
    WHERE ativo = 1
    ORDER BY nome
");

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Editar Equipamento</h2>

        <span class="badge bg-primary fs-5">
            <?= htmlspecialchars($equipamento['patrimonio']) ?>
        </span>

    </div>

    <form action="atualizar.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $equipamento['id'] ?>"
        >

        <div class="alert alert-info">

            O patrimônio
            <strong><?= htmlspecialchars($equipamento['patrimonio']) ?></strong>
            não pode ser alterado.

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Tipo
                </label>

                <select
                    name="tipo_id"
                    class="form-select"
                    required
                >

                    <?php foreach ($tipos as $tipo): ?>

                        <option
                            value="<?= $tipo['id'] ?>"
                            <?= $equipamento['tipo_id'] == $tipo['id'] ? 'selected' : '' ?>
                        >

                            <?= htmlspecialchars($tipo['nome']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Setor
                </label>

                <select
                    name="setor_id"
                    class="form-select"
                >

                    <option value="">
                        Estoque
                    </option>

                    <?php foreach ($setores as $setor): ?>

                        <option
                            value="<?= $setor['id'] ?>"
                            <?= $equipamento['setor_id'] == $setor['id'] ? 'selected' : '' ?>
                        >

                            <?= htmlspecialchars($setor['nome']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>


        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Marca
                </label>

                <input
                    type="text"
                    name="marca"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['marca'] ?? '') ?>"
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Modelo
                </label>

                <input
                    type="text"
                    name="modelo"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['modelo'] ?? '') ?>"
                >

            </div>

        </div>


        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Número de Série
                </label>

                <input
                    type="text"
                    name="numero_serie"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['numero_serie'] ?? '') ?>"
                >

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Patrimônio Antigo
                </label>

                <input
                    type="text"
                    name="patrimonio_antigo"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['patrimonio_antigo'] ?? '') ?>"
                >

            </div>

        </div>


        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Processador
                </label>

                <input
                    type="text"
                    name="processador"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['processador'] ?? '') ?>"
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Memória RAM
                </label>

                <input
                    type="text"
                    name="memoria"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['memoria'] ?? '') ?>"
                >

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Armazenamento
                </label>

                <input
                    type="text"
                    name="armazenamento"
                    class="form-control"
                    value="<?= htmlspecialchars($equipamento['armazenamento'] ?? '') ?>"
                >

            </div>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Sistema Operacional
            </label>

            <input
                type="text"
                name="sistema_operacional"
                class="form-control"
                value="<?= htmlspecialchars($equipamento['sistema_operacional'] ?? '') ?>"
            >

        </div>


        <div class="mb-3">

            <label class="form-label">
                Status
            </label>

            <select
                name="status"
                class="form-select"
            >

                <option
                    value="Estoque"
                    <?= $equipamento['status'] == 'Estoque' ? 'selected' : '' ?>
                >
                    Estoque
                </option>

                <option
                    value="Em Uso"
                    <?= $equipamento['status'] == 'Em Uso' ? 'selected' : '' ?>
                >
                    Em Uso
                </option>

                <option
                    value="Manutenção"
                    <?= $equipamento['status'] == 'Manutenção' ? 'selected' : '' ?>
                >
                    Manutenção
                </option>

                <option
                    value="Baixado"
                    <?= $equipamento['status'] == 'Baixado' ? 'selected' : '' ?>
                >
                    Baixado
                </option>

            </select>

        </div>


        <div class="mb-3">

            <label class="form-label">
                Observações
            </label>

            <textarea
                name="observacoes"
                class="form-control"
                rows="4"
            ><?= htmlspecialchars($equipamento['observacoes'] ?? '') ?></textarea>

        </div>


        <button
            type="submit"
            class="btn btn-success"
        >

            Salvar alterações

        </button>

        <a
            href="visualizar.php?id=<?= $equipamento['id'] ?>"
            class="btn btn-secondary"
        >

            Cancelar

        </a>

    </form>

</div>