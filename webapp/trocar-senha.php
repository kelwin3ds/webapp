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
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card px-4 py-5 shadow border-0">
            <div class="card-body">
                <p class="h3 mb-1 fw-semibold">Trocar senha</p>
                <p class="mb-4 text-secondary">Informe sua senha atual e a nova para atualizar.</p>
                <form action="index.php">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control py-2" id="login" required placeholder="Login">
                        </div>
                        <div class="col">
                            <label for="senha" class="form-label">Senha atual</label>
                            <input type="password" class="form-control py-2" id="senha" required placeholder="Senha atual">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col">
                            <label for="n_senha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control py-2" id="n_senha" required placeholder="Nova Senha">
                        </div>
                        <div class="col">
                            <label for="c_senha" class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control py-2" id="c_senha" required placeholder="Confirmar senha">
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
</html>