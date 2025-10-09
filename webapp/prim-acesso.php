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
                <p class="h3 mb-1 fw-semibold">Nova senha</p>
                <p class="mb-4 text-secondary">Defina a sua nova senha.</p>
                <form action="nova-senha.php" method="post">
                    <div class="row mb-5 row-cols-1 g-3">
                        <div class="col">
                            <label for="n_senha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control py-2" id="n_senha" name="n_senha" required placeholder="Nova Senha">
                        </div>
                        <div class="col">
                            <label for="c_senha" class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control py-2" id="c_senha" name="c_senha" required placeholder="Confirmar senha">
                        </div>
                    </div>
                    <div class="mb-5">
                    </div>
                    <div class="row g-2">
                        <div class="col-">
                            <button type="submit" class="btn btn-primary w-100">Definir senha</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</html>