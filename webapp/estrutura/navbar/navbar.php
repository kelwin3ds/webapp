<header <?php if (empty($float)) {
            echo 'class="float sticky-top"';
        } ?>>
    <nav class="navbar navbar-expand-lg bg-body" data-bs-theme="light">
        <div class="container-fluid px-lg-5">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-4 mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="criar-evento.php">
                            <i class="bi bi-plus-circle"></i>&nbsp;Criar evento
                        </a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <div class="nav-item dropdown border rounded-pill p-1">
                        <button class="btn border-0 d-flex" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2"><i class="bi bi-person-circle"></i>&nbsp;<?= $_SESSION['nome'] ?></span>
                            <div class="bg-body-secondary px-1 rounded-circle">
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="menu/configuracoes.php"><i class="bi bi-person-fill me-2"></i>Perfil</a></li>
                            <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="controladores/logout.php"><i class="bi bi-door-open me-2"></i>Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>