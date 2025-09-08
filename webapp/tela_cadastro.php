<?php
include('conexao_db.php');

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios (login, senha, nome, tipo, acesso, status, tentativas_senha) 
            VALUES ('$login', '$senha', '$nome', '1', 1, '1', 0)";

    if (mysqli_query($conexao, $sql)) {
        // echo "Registro inserido com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
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
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card px-4 py-5 shadow border-0">
            <div class="card-body">
                <h3 class="mb-1 fw-semibold">Cadastro</h3>
                <p class="mb-5 text-secondary">Coloque seu login e senha para criar uma conta</p>
                <form action="tela_cadastro.php" method="POST">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control py-2" id="nome" name="nome" required placeholder="Nome">
                        </div>
                        <div class="col">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control py-2" id="login" name="login" required placeholder="Login">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control py-2" id="senha" name="senha" required placeholder="Senha">
                        </div>
                        <div class="col">
                            <label for="c-senha" class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control py-2" id="c-senha" name="c-senha" required placeholder="Confirmar senha">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary w-100">Validar</button>
                        </div>
                        <div class="col-2">
                            <a href="index.php" class="btn btn-outline-primary w-100"><i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</html>