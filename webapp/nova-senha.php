<?php
session_start();
include('conexao_db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $n_senha = $_POST['n_senha'];

        $sql = "SELECT * FROM usuarios WHERE login = '$login'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $linha = mysqli_fetch_array($resultado);
            $sql = "UPDATE usuarios SET senha = '$n_senha' WHERE login = '$login'";
            if (mysqli_query($conexao, $sql)) {
                // echo "Registro inserido com sucesso!";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
            }
            $_SESSION['msg_alert'] = ['success', "Senha trocada com sucesso!"];
            header('Location: homepage.php');
        } else {
            $_SESSION['msg_alert'] = ['danger', "Login não encontrado!"];
            header('Location: index.php');
        }
    } else {
        $_SESSION['msg_alert'] = ['danger', "Login não encontrado!"];
        header('Location: index.php');
    }
}

mysqli_close($conexao);
?>