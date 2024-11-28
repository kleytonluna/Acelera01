<?php
$hostname = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "cadastro";

// Criando a conexão
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Recebendo os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Validando a senha antes da inserção
if (strlen($senha) < 8) {
    echo "<script>alert('A SENHA DEVE TER PELO MENOS 8 CARACTERES.');</script>";
    
} elseif (!preg_match('/[A-Za-z]/', $senha)) {
    echo "<script>alert('A SENHA DEVE CONTER PELO MENOS 1 UMA LETRA.');</script>";
} elseif (!preg_match('/[0-9]/', $senha)) {
    echo "<script>alert('A SENHA DEVE CONTER PELO MENOS UM NÚMERO.');</script>";
} else {
    // Prepared statement para evitar SQL injection
    $stmt = $conn->prepare("INSERT INTO clientes (email, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('USUÁRIO CADASTRADO COM SUCESSO!');</script>";
        header("Location: http://localhost/Acelera-nova-versao-01/tela-principal.html");
        exit();
    } else {
        echo "<script>alert('ERRO AO CADASTRAR O USUÁRIO: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
