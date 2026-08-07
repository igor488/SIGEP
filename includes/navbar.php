<div class="topbar">

    <div class="left-topbar">

        <button id="menu-toggle" class="toggle-btn">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text" placeholder="Pesquisar...">

        </div>

    </div>

    <div class="right-topbar">

        <div class="clock">

            <i class="fa-solid fa-calendar-days"></i>

            <span id="datetime"></span>

        </div>

        <div class="notification">

            <i class="fa-solid fa-bell"></i>

            <span class="badge">3</span>

        </div>

        <div class="profile">

            <div class="profile-img">

                <i class="fa-solid fa-user"></i>

            </div>

            <div>

                <strong>

                    <?= $_SESSION['usuario'] ?? "Administrador" ?>

                </strong>

                <br>

                <small>Administrador</small>

            </div>

        </div>

        <a href="/SIGEP/logout.php" class="logout-btn">

            <i class="fa-solid fa-right-from-bracket"></i>

        </a>

    </div>

</div>