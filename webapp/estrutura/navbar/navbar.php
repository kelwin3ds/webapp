<header <?php if (empty($float)) {
            echo 'class="float sticky-top"';
        } ?>>
    <nav class="navbar navbar-expand-lg bg-body shadow-sm" data-bs-theme="light">
        <div class="container-xxl px-lg-5">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="position-relative">
                <input type="text" class="form-control rounded-pill ps-5" placeholder="Pesquisar" aria-label="Search">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-4 mb-3 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Comprar
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="compras.php?tipo=carro&codicao=usado">
                                    <i class="bi bi-car-front"></i>
                                    Carros usados
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="compras.php?tipo=carro&codicao=novo">
                                    <i class="bi bi-car-front-fill"></i>
                                    Carros novos
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="compras.php?tipo=moto&codicao=usado">
                                    <i class="bi bi-bicycle"></i>
                                    Motos usadas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="compras.php?tipo=moto&codicao=novo">
                                    <i class="bi bi-bicycle"></i>
                                    Motos novas
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Vender
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="vender-placa.php">
                                    <i class="bi bi-car-front-fill"></i>
                                    Vender carro
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="vender-placa.php">
                                    <i class="bi bi-bicycle"></i>
                                    Vender moto
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <div class="vr"></div>
                    <div class="nav-item dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i>&nbsp;<?= $_SESSION['nome'] ?></button>
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