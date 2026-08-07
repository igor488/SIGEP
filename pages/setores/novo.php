<div class="container mt-4">

<h2>Novo Setor</h2>

<form action="salvar.php" method="POST">

<div class="mb-3">

<label>Nome</label>

<input
type="text"
name="nome"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Responsável</label>

<input
type="text"
name="responsavel"
class="form-control">

</div>

<div class="mb-3">

<label>Localização</label>

<input
type="text"
name="localizacao"
class="form-control">

</div>

<div class="mb-3">

<label>Descrição</label>

<textarea
name="descricao"
class="form-control"></textarea>

</div>

<button class="btn btn-success">

Salvar

</button>

<a href="index.php" class="btn btn-secondary">

Cancelar

</a>

</form>

</div>