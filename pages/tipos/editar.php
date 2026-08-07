<?php

include("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM tipos WHERE id = ?");
$sql->execute([$id]);

$tipo = $sql->fetch(PDO::FETCH_ASSOC);

?>

<div class="container mt-4">

    <h2>Editar Tipo</h2>

    <form action="atualizar.php" method="POST">

        <input type="hidden" name="id" value="<?= $tipo['id']; ?>">

        <div class="mb-3">

            <label>Nome</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                value="<?= $tipo['nome']; ?>"
                required>

        </div>

        <div class="mb-3">

            <label>Prefixo</label>

            <input
                type="text"
                name="prefixo"
                class="form-control"
                value="<?= $tipo['prefixo']; ?>"
                maxlength="5"
                required>

        </div>

        <div class="mb-3">

            <label>Descrição</label>

            <textarea
                name="descricao"
                class="form-control"><?= $tipo['descricao']; ?></textarea>

        </div>

        <button class="btn btn-success">

            Atualizar

        </button>

        <a href="index.php" class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>