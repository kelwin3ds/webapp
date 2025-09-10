<?php
session_start();
include('conexao_db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $n_senha = $_POST['n_senha'] ?? null;

        $sql = "SELECT * FROM usuarios WHERE login = '$login'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_array($resultado);
            if ($linha['status'] != 'B') {
                if ($linha['senha'] == $senha) {
                    if ($linha['acesso'] == 1) {
                        $_SESSION['nome'] = $linha['nome'];
                        $_SESSION['login'] = $linha['login'];
                        header('Location: prim-acesso.php');
                    } else {
                        $_SESSION['nome'] = $linha['nome'];
                        $_SESSION['login'] = $linha['login'];
                        header('Location: homepage.php');
                    };
                } else {
                    $sql = "UPDATE usuarios SET tent_senha = tent_senha + 1 WHERE login = '$login'";
                    if (mysqli_query($conexao, $sql)) {
                        // echo "Registro inserido com sucesso!";
                    } else {
                        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
                    }

                    if ((2 - $linha['tent_senha']) === 0) {
                        $_SESSION['erro_login'] = "Seu login foi bloqueado!";
                        $sql = "UPDATE usuarios SET status = 'B' WHERE login = '$login'";
                        if (mysqli_query($conexao, $sql)) {
                            // echo "Registro inserido com sucesso!";
                        } else {
                            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
                        }
                        header('Location: index.php');
                    } else {
                        $_SESSION['erro_login'] = "Senha incorreta. Você tem mais " . 2 - $linha['tent_senha'] . " tentativas!";
                        header('Location: index.php');
                    };
                };
            } else {
                $_SESSION['erro_login'] = "Usuário bloqueado!";
                header('Location: index.php');
            };
        } else {
            $_SESSION['erro_login'] = "Login incorreto!";
            header('Location: index.php');
        }
    }
}

mysqli_close($conexao);
