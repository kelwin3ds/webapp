<?php
session_start();

session_unset();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-body-tertiary">
    <?php if (isset($_SESSION['msg_alert'])): ?>
        <div class="position-fixed d-flex justify-content-center start-50 translate-middle-x mb-5 z-3 bottom-0">
            <div id="alert-mensagem" class="alert alert-<?= $_SESSION['msg_alert'][0] ?> alert-dismissible small h-100" role="alert"">
                <div><span><i class="bi <?php if ($_SESSION['msg_alert'][0] == 'danger') {echo 'bi-exclamation-triangle';} else {echo 'bi-check';} ?>"></i></span> <?= $_SESSION['msg_alert'][1] ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php unset($_SESSION['msg_alert']); ?>
    <?php endif; ?>
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card px-4 py-5 shadow border-0">
            <div class="card-body">
                <h3 class="mb-1 fw-semibold">Login</h3>
                <p class="mb-5 text-secondary">Coloque seu login e senha para ter acesso</p>
                <form action="login.php" method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control py-2" id="login" name="login" required placeholder="Login">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control py-2" name="senha" id="senha" required placeholder="Senha">
                    </div>
                    <p class="text-start mb-4">
                        <a href="trocar-senha.php" class="link-primary link-opacity-75 link-opacity-100-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            Trocar senha
                        </a>
                    </p>
                    <div class="row g-2">
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary w-100">Validar</button>
                        </div>
                        <div class="col-2">
                            <button type="reset" class="btn btn-outline-primary w-100"><i class="bi bi-backspace"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    $(function() {
        const alt = $('#alert-mensagem').parent();

        if (alt.length) {
            alt.show();
            alt.delay(1500).fadeOut(1500, function() {
                alt.remove();
            });
        }
    });
</script>

</html>