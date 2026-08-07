<?php

include("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$sql->execute([$id]);

$usuario = $sql->fetch(PDO::FETCH_ASSOC);

?>

<div class="container mt-4">

    <h2>Editar Usuário</h2>

    <form action="atualizar.php" method="POST">

        <input type="hidden" name="id" value="<?= $usuario['id']; ?>">

        <div class="mb-3">

            <label>Nome</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                value="<?= htmlspecialchars($usuario['nome']); ?>"
                required>

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($usuario['email']); ?>"
                required>

        </div>

        <div class="mb-3">

            <label>Nova Senha</label>

            <input
                type="password"
                name="senha"
                class="form-control">

            <small class="text-muted">
                Deixe em branco para manter a senha atual.
            </small>

        </div>

        <div class="mb-3">

            <label>Nível</label>

            <select name="nivel" class="form-select">

                <option value="Administrador" <?= $usuario['nivel'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>

                <option value="TI" <?= $usuario['nivel'] == 'TI' ? 'selected' : '' ?>>TI</option>

                <option value="Consulta" <?= $usuario['nivel'] == 'Consulta' ? 'selected' : '' ?>>Consulta</option>

            </select>

        </div>

        <button class="btn btn-success">

            Atualizar

        </button>

        <a href="index.php" class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>