<div class="container mt-4">

<h2>Novo Tipo</h2>

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

<label>Prefixo</label>

<input
type="text"
name="prefixo"
class="form-control"
maxlength="5"
required>

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