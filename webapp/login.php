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
                    if ($linha['acesso'] == 0) {
                        $_SESSION['nome'] = $linha['nome'];
                        $_SESSION['login'] = $linha['login'];
                        $_SESSION['acesso'] = $linha['acesso'];
                        header('Location: prim-acesso.php');
                    } else {
                        if ($linha['tipo'] == 0) {
                            $_SESSION['nome'] = $linha['nome'];
                            $_SESSION['login'] = $linha['login'];
                            $_SESSION['acesso'] = $linha['acesso'];
                            header('Location: homepage-admin.php');
                            exit;
                        } else {
                            $_SESSION['nome'] = $linha['nome'];
                            $_SESSION['login'] = $linha['login'];
                            $_SESSION['acesso'] = $linha['acesso'];
                            header('Location: homepage.php');
                            exit;
                        }
                    };
                } else {
                    $sql = "UPDATE usuarios SET tent_senha = tent_senha + 1 WHERE login = '$login'";
                    if (mysqli_query($conexao, $sql)) {
                        // echo "Registro inserido com sucesso!";
                    } else {
                        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
                    }

                    if ((2 - $linha['tent_senha']) === 0) {
                        $_SESSION['msg_alert'] = ['danger', "Seu login foi bloqueado!"];
                        $sql = "UPDATE usuarios SET status = 'B' WHERE login = '$login'";
                        if (mysqli_query($conexao, $sql)) {
                            // echo "Registro inserido com sucesso!";
                        } else {
                            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
                        }
                        header('Location: index.php#1');
                        exit;
                    } else {
                        $_SESSION['msg_alert'] = ['danger', "Senha incorreta. Você tem mais " . 2 - $linha['tent_senha'] . " tentativas!"];
                        header('Location: index.php#2');
                        exit;
                    };
                };
            } else {
                $_SESSION['msg_alert'] = ['danger', "Usuário bloqueado!"];
                header('Location: index.php#3');
                exit;
            };
        } else {
            $_SESSION['msg_alert'] = ['danger', "Login incorreto!"];
            header('Location: index.php#4');
            exit;
        }
    }
}

mysqli_close($conexao);
