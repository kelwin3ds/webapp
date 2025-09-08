<?php
session_start();
include('conexao_db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE senha = '$senha' AND login = '$login'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_array($resultado);
            $_SESSION['nome'] = $linha['nome'];
            $_SESSION['login'] = $linha['login'];
            header('Location: homepage.php');
            echo "Logado com sucesso, bem vindo: " . $_SESSION['nome'];
        } else {
            echo "<script>alert('Login ou senha incorretos');</script>";
        }
    }
}

mysqli_close($conexao);
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
                <h3 class="mb-1 fw-semibold">Login</h3>
                <p class="mb-5 text-secondary">Coloque seu login e senha para ter acesso</p>
                <form action="index.php" method="post" class="mb-3">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</html>