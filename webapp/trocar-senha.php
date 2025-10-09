<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
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
                <p class="h3 mb-1 fw-semibold">Trocar senha</p>
                <p class="mb-4 text-secondary">Informe sua senha atual e a nova para atualizar.</p>
                <form action="senha-troca.php" method="post">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" class="form-control py-2" id="login" required placeholder="Login">
                        </div>
                        <div class="col">
                            <label for="senha" class="form-label">Senha atual</label>
                            <input type="password" name="senha" class="form-control py-2" id="senha" required placeholder="Senha atual">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col">
                            <label for="n_senha" class="form-label">Nova Senha</label>
                            <input type="password" name="n_senha" class="form-control py-2" id="n_senha" required placeholder="Nova Senha">
                        </div>
                        <div class="col">
                            <label for="c_senha" class="form-label">Confirmar senha</label>
                            <input type="password" name="c_senha" class="form-control py-2" id="c_senha" required placeholder="Confirmar senha">
                        </div>
                    </div>
                    </div>
                    <div class="mb-5">
                    <div class="row g-2">
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary w-100">Trocar senha</button>
                        </div>
                        <div class="col-2">
                            <a href="javascript:history.go(-1)" class="btn btn-outline-primary w-100"><i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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