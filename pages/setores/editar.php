<?php

include("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM setores WHERE id = ?");

$sql->execute([$id]);

$setor = $sql->fetch(PDO::FETCH_ASSOC);

?>

<div class="container mt-4">

<h2>Editar Setor</h2>

<form action="atualizar.php" method="POST">

<input type="hidden" name="id" value="<?= $setor['id']; ?>">

<div class="mb-3">

<label>Nome</label>

<input

type="text"

name="nome"

class="form-control"

value="<?= $setor['nome']; ?>"

required>

</div>

<div class="mb-3">

<label>Responsável</label>

<input

type="text"

name="responsavel"

class="form-control"

value="<?= $setor['responsavel']; ?>">

</div>

<div class="mb-3">

<label>Localização</label>

<input

type="text"

name="localizacao"

class="form-control"

value="<?= $setor['localizacao']; ?>">

</div>

<div class="mb-3">

<label>Descrição</label>

<textarea

name="descricao"

class="form-control"><?= $setor['descricao']; ?></textarea>

</div>

<button class="btn btn-success">

Atualizar

</button>

<a href="index.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>