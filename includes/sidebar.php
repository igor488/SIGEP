<div class="sidebar" id="sidebar">

    <div class="logo-area">

        <div class="logo-icon">
            <i class="fa-solid fa-microchip"></i>
        </div>

        <div class="logo-text">
            <h4>SIGEP</h4>
            <small>Patrimônio</small>
        </div>

    </div>

    <div class="user-box">

        <div class="avatar">
            <i class="fa-solid fa-user"></i>
        </div>

        <div>

            <strong>

                <?php
                    echo $_SESSION['usuario'] ?? 'Administrador';
                ?>

            </strong>

            <br>

            <small>Administrador</small>

        </div>

    </div>

    <ul class="menu">

        <li class="active">
            <a href="#">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-computer"></i>
                Equipamentos
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                Movimentações
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-boxes-stacked"></i>
                Inventário
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Manutenção
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-users"></i>
                Usuários
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-building"></i>
                Setores
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-tag"></i>
                Tipos
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-chart-column"></i>
                Relatórios
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-gear"></i>
                Configurações
            </a>
        </li>

    </ul>

</div>