<?php
session_start();
include('conexao_db.php');
echo "Logado com sucesso, bem vindo: " . $_SESSION['nome'];

$login = $_SESSION['login'];

$sql = "UPDATE usuarios SET acesso = acesso + 1 WHERE login = '$login'";

if (mysqli_query($conexao, $sql)) {
    // echo "Registro inserido com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
}


mysqli_close($conexao);
?>
