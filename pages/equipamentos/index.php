<?php

include("../../config/auth.php");
include("../../config/conexao.php");


// =====================================================
// FILTROS
// =====================================================

$pesquisa = trim($_GET['pesquisa'] ?? '');
$tipo     = trim($_GET['tipo'] ?? '');
$setor    = trim($_GET['setor'] ?? '');
$status   = trim($_GET['status'] ?? '');


// =====================================================
// CONSULTA
// =====================================================

$sql = "
    SELECT
        e.id,
        e.patrimonio,
        e.marca,
        e.modelo,
        e.status,
        e.numero_serie,

        t.nome AS tipo,

        s.nome AS setor

    FROM equipamentos e

    INNER JOIN tipos t
        ON t.id = e.tipo_id

    LEFT JOIN setores s
        ON s.id = e.setor_id

    WHERE e.ativo = 1
";


// =====================================================
// PARÂMETROS
// =====================================================

$params = [];


// =====================================================
// PESQUISA
// =====================================================

if ($pesquisa !== '') {

    $sql .= "
        AND (
            e.patrimonio LIKE ?
            OR e.marca LIKE ?
            OR e.modelo LIKE ?
            OR e.numero_serie LIKE ?
        )
    ";

    $termo = "%{$pesquisa}%";

    $params[] = $termo;
    $params[] = $termo;
    $params[] = $termo;
    $params[] = $termo;
}


// =====================================================
// FILTRO POR TIPO
// =====================================================

if ($tipo !== '') {

    $sql .= "
        AND t.nome LIKE ?
    ";

    $params[] = "%{$tipo}%";
}


// =====================================================
// FILTRO POR SETOR
// =====================================================

if ($setor !== '') {

    $sql .= "
        AND s.nome LIKE ?
    ";

    $params[] = "%{$setor}%";
}


// =====================================================
// FILTRO POR STATUS
// =====================================================

if ($status !== '') {

    $sql .= "
        AND e.status LIKE ?
    ";

    $params[] = "%{$status}%";
}


// =====================================================
// ORDENAÇÃO
// =====================================================

$sql .= "
    ORDER BY e.id DESC
";


// =====================================================
// EXECUTAR
// =====================================================

$stmt = $pdo->prepare($sql);

$stmt->execute($params);


// =====================================================
// TIPOS PARA O SELECT
// =====================================================

$tipos = $pdo->query("
    SELECT id, nome
    FROM tipos
    WHERE ativo = 1
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);


// =====================================================
// SETORES PARA O SELECT
// =====================================================

$setores = $pdo->query("
    SELECT id, nome
    FROM setores
    WHERE ativo = 1
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid mt-4">


    <!-- =================================================
         CABEÇALHO
    ================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Equipamentos
            </h2>

            <p class="text-muted mb-0">
                Controle e inventário dos equipamentos da empresa
            </p>

        </div>


        <div>

            <a
                href="novo.php"
                class="btn btn-primary"
            >

                <i class="fa-solid fa-plus"></i>

                Novo Equipamento

            </a>

        </div>

    </div>



    <!-- =================================================
         FILTROS
    ================================================== -->

    <div class="card mb-4">

        <div class="card-header">

            <strong>
                <i class="fa-solid fa-filter"></i>
                Filtros
            </strong>

        </div>


        <div class="card-body">

            <form method="GET" class="row g-3">


                <!-- PESQUISA -->

                <div class="col-md-4">

                    <label class="form-label">
                        Pesquisar
                    </label>

                    <input
                        type="text"
                        name="pesquisa"
                        class="form-control"
                        placeholder="Patrimônio, marca, modelo ou série..."
                        value="<?= htmlspecialchars($pesquisa) ?>"
                    >

                </div>


                <!-- TIPO -->

                <div class="col-md-2">

                    <label class="form-label">
                        Tipo
                    </label>

                    <select
                        name="tipo"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

                        <?php foreach ($tipos as $t): ?>

                            <option
                                value="<?= htmlspecialchars($t['nome']) ?>"
                                <?= $tipo === $t['nome'] ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars($t['nome']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- SETOR -->

                <div class="col-md-2">

                    <label class="form-label">
                        Setor
                    </label>

                    <select
                        name="setor"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

                        <?php foreach ($setores as $s): ?>

                            <option
                                value="<?= htmlspecialchars($s['nome']) ?>"
                                <?= $setor === $s['nome'] ? 'selected' : '' ?>
                            >

                                <?= htmlspecialchars($s['nome']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- STATUS -->

                <div class="col-md-2">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

                        <option
                            value="Estoque"
                            <?= $status === 'Estoque' ? 'selected' : '' ?>
                        >
                            Estoque
                        </option>

                        <option
                            value="Em Uso"
                            <?= $status === 'Em Uso' ? 'selected' : '' ?>
                        >
                            Em Uso
                        </option>

                        <option
                            value="Manutenção"
                            <?= $status === 'Manutenção' ? 'selected' : '' ?>
                        >
                            Manutenção
                        </option>

                        <option
                            value="Baixado"
                            <?= $status === 'Baixado' ? 'selected' : '' ?>
                        >
                            Baixado
                        </option>

                    </select>

                </div>


                <!-- BOTÕES -->

                <div class="col-md-2 d-flex align-items-end">

                    <div class="d-flex gap-2 w-100">

                        <button
                            type="submit"
                            class="btn btn-primary flex-grow-1"
                        >

                            <i class="fa-solid fa-search"></i>

                            Filtrar

                        </button>


                        <a
                            href="index.php"
                            class="btn btn-secondary"
                            title="Limpar filtros"
                        >

                            <i class="fa-solid fa-xmark"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>



    <!-- =================================================
         TABELA
    ================================================== -->

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-striped table-bordered table-hover align-middle"
                >

                    <thead class="table-dark">

                        <tr>

                            <th>
                                Patrimônio
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Marca
                            </th>

                            <th>
                                Modelo
                            </th>

                            <th>
                                Setor
                            </th>

                            <th>
                                Status
                            </th>

                            <th
                                width="220"
                                class="text-center"
                            >
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if ($stmt->rowCount() > 0): ?>


                        <?php foreach ($stmt as $eq): ?>


                            <tr>


                                <!-- PATRIMÔNIO -->

                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $eq['patrimonio']
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- TIPO -->

                                <td>

                                    <?= htmlspecialchars(
                                        $eq['tipo']
                                    ) ?>

                                </td>


                                <!-- MARCA -->

                                <td>

                                    <?= htmlspecialchars(
                                        $eq['marca'] ?? '-'
                                    ) ?>

                                </td>


                                <!-- MODELO -->

                                <td>

                                    <?= htmlspecialchars(
                                        $eq['modelo'] ?? '-'
                                    ) ?>

                                </td>


                                <!-- SETOR -->

                                <td>

                                    <?= htmlspecialchars(
                                        $eq['setor'] ?? 'Estoque'
                                    ) ?>

                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    $classeStatus = match ($eq['status']) {

                                        'Estoque'
                                            => 'bg-secondary',

                                        'Em Uso'
                                            => 'bg-success',

                                        'Manutenção'
                                            => 'bg-warning text-dark',

                                        'Baixado'
                                            => 'bg-danger',

                                        default
                                            => 'bg-secondary'

                                    };

                                    ?>


                                    <span
                                        class="badge <?= $classeStatus ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $eq['status']
                                        ) ?>

                                    </span>


                                </td>


                                <!-- AÇÕES -->

                               <td class="text-center">

    <a
        href="visualizar.php?id=<?= $eq['id'] ?>"
        class="btn btn-info btn-sm"
    >
        Visualizar
    </a>

    <a
        href="editar.php?id=<?= $eq['id'] ?>"
        class="btn btn-warning btn-sm"
    >
        Editar
    </a>

    <a
        href="etiqueta.php?id=<?= $eq['id'] ?>"
        target="_blank"
        class="btn btn-dark btn-sm"
    >
        Etiqueta
    </a>

    <a
        href="excluir.php?id=<?= $eq['id'] ?>"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Deseja realmente desativar este equipamento?')"
    >
        Excluir
    </a>

</td>


                            </tr>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4"
                            >

                                <i
                                    class="fa-solid fa-box-open fa-2x text-muted mb-2"
                                ></i>

                                <br>

                                <span class="text-muted">

                                    Nenhum equipamento encontrado.

                                </span>

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>