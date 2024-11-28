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
$data = $_POST['data'];
$hora = $_POST['hora'];
$especialidade = $_POST['especialidade'];

$sql = "INSERT INTO marcacao (nome, data, hora, especialidade) VALUES('$nome', '$data', '$hora', '$especialidade')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('A CONSULTA DE\\ $nome\\ MARCADA NA Data: $data\\ E Hora: $hora');</script>";
    echo "<script>window.location.href='http://localhost/Acelera-nova-versao-01/tela-principal.html';</script>"; // Substitua por sua página de sucesso
    exit(); // Importante encerrar a execução após o redirecionamento
} else {
    echo "<script>alert('NÃO FOI POSSÍVEL MARCAR A CONSULTA DO USUÁRIO! " . $conn->error . "');</script>";
}

$conn->close();

?>
