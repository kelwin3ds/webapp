<?php
include('conexao_db.php');

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuarios (login, senha, nome, tipo, acesso, status, tent_senha) 
            VALUES ('$login', '$senha', '$nome', '1', 0, 'A', 0)";

    if (mysqli_query($conexao, $sql)) {
        // echo "Registro inserido com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    header('Location: homepage.php');
    mysqli_close($conexao);
}
?>