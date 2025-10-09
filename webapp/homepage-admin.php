<?php
session_start();
include('conexao_db.php');

$login = $_SESSION['login'];

$sql = "UPDATE usuarios SET acesso = acesso + 1 WHERE login = '$login'";

if (mysqli_query($conexao, $sql)) {
    // echo "Registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
};

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql);
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
                <div><span><i class=" bi <?php if ($_SESSION['msg_alert'][0] == 'danger') {
                                                echo 'bi-exclamation-triangle';
                                            } else {
                                                echo 'bi-check';
                                            } ?>"></i></span> <?= $_SESSION['msg_alert'][1] ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        <?php unset($_SESSION['msg_alert']); ?>
    <?php endif; ?>
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card px-4 pt-4 pb-4 shadow border-0">
            <div class="card-header bg-transparent border-0 text-end pb-0">
                <a href="logout.php" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover link-secondary">Sair <span><i class="bi bi-door-open"></i></span></a>
            </div>
            <div class="card-body">
                <h3 class="mb-1 fw-semibold">Usuários cadastrados</h3>
                <p class="mb-5 text-secondary">Coloque seu login e senha para ter acesso</p>
                <div class="table-responsive mb-4" style="max-height: 40vh;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Login</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Senha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Acessos</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider overflow-auto">
                            <?php
                            while ($linha = mysqli_fetch_array($resultado)) {

                                echo "<tr>
                                <th scope=\"row\">" . $linha['login'] . "</th>
                                <td>" . $linha['nome'] . "</td>
                                <td>" . $linha['senha'] . "</td>
                                <td>" . $linha['tipo'] . "</td>
                                <td>" . $linha['acesso'] . "</td>
                                <td>" . $linha['status'] . "</td>
                            </tr>";
                            };

                            mysqli_close($conexao);
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row float-end">
                    <button class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#cadastro_modal">Cadastrar +</button>
                </div>
                <div class="modal fade" id="cadastro_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form id="cadastro-novo" action="cadastro.php" method="POST" class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar novo usuário</h1>
                            </div>
                            <div class="modal-body pt-4 pb-5">
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
                                <div class="row">
                                    <div class="col">
                                        <label for="senha" class="form-label">Senha</label>
                                        <input type="password" class="form-control py-2" id="senha" name="senha" required placeholder="Senha">
                                    </div>
                                    <div class="col">
                                        <label for="c-senha" class="form-label">Confirmar senha</label>
                                        <input type="password" class="form-control py-2" id="c-senha" name="c-senha" required placeholder="Confirmar senha">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-primary" data-bs-dismiss="modal" onclick="" value="Cancelar">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
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