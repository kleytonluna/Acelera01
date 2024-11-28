<?php

$hostname = "localhost";
$usuario = "root";
$senha = ""; // se tiver senha, coloque aqui
$bancodedados = "cadastro";

// Criando conexão
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conn) {
    die("<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>");
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

// Verificando se o usuário já está cadastrado
$check_sql = "SELECT * FROM usuario WHERE email='$email' OR cpf='$cpf'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Usuário já cadastrado com este e-mail ou CPF!');</script>";
    echo "<script>window.history.back();</script>"; // Redireciona o usuário de volta para o formulário
} else {
    $sql = "INSERT INTO usuario (nome, email, cpf, senha) VALUES('$nome', '$email', '$cpf', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('USUÁRIO CADASTRADO!');</script>";
        echo "<script>window.location.href='http://localhost/Acelera-nova-versao-01/login.html';</script>"; // Substitua por sua página de sucesso
        exit(); // Importante encerrar a execução após o redirecionamento
    } else {
        echo "<script>alert('NÃO FOI POSSÍVEL CADASTRAR O USUÁRIO! " . $conn->error . "');</script>";
    }
}

$conn->close();

?>
