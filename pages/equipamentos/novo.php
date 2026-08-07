<?php

include("../../config/auth.php");
include("../../config/conexao.php");

$tipos=$pdo->query("SELECT * FROM tipos WHERE ativo=1 ORDER BY nome");
$setores=$pdo->query("SELECT * FROM setores WHERE ativo=1 ORDER BY nome");

?>

<div class="container mt-4">

<h2>Novo Equipamento</h2>

<form action="salvar.php" method="POST">

<div class="row">

<div class="col-md-6">

<label>Tipo</label>

<select name="tipo_id" class="form-select" required>

<option value="">Selecione</option>

<?php foreach($tipos as $t){ ?>

<option value="<?= $t['id']; ?>">

<?= $t['nome']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="col-md-6">

<label>Setor</label>

<select name="setor_id" class="form-select">

<option value="">Estoque</option>

<?php foreach($setores as $s){ ?>

<option value="<?= $s['id']; ?>">

<?= $s['nome']; ?>

</option>

<?php } ?>

</select>

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<label>Marca</label>

<input
type="text"
name="marca"
class="form-control">

</div>

<div class="col-md-6">

<label>Modelo</label>

<input
type="text"
name="modelo"
class="form-control">

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<label>Número de Série</label>

<input
type="text"
name="numero_serie"
class="form-control">

</div>

<div class="col-md-6">

<label>Patrimônio Antigo</label>

<input
type="text"
name="patrimonio_antigo"
class="form-control">

</div>

</div>

<br>

<div class="row">

<div class="col-md-4">

<label>Processador</label>

<input
type="text"
name="processador"
class="form-control">

</div>

<div class="col-md-4">

<label>Memória RAM</label>

<input
type="text"
name="memoria"
class="form-control">

</div>

<div class="col-md-4">

<label>Armazenamento</label>

<input
type="text"
name="armazenamento"
class="form-control">

</div>

</div>

<br>

<div class="mb-3">

<label>Sistema Operacional</label>

<input
type="text"
name="sistema_operacional"
class="form-control">

</div>

<div class="mb-3">

<label>Observações</label>

<textarea
name="observacoes"
class="form-control"></textarea>

</div>

<button class="btn btn-success">

Cadastrar Equipamento

</button>

</form>

</div>