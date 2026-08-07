<div class="container mt-4">

    <h2>Novo Usuário</h2>

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

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Senha</label>

            <input
                type="password"
                name="senha"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Confirmar Senha</label>

            <input
                type="password"
                name="confirmar_senha"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Nível</label>

            <select
                name="nivel"
                class="form-select">

                <option value="Administrador">Administrador</option>

                <option value="TI">TI</option>

                <option value="Consulta">Consulta</option>

            </select>

        </div>

        <button class="btn btn-success">

            Salvar

        </button>

        <a href="index.php" class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>