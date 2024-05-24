<?php

// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Recebe e sanitiza os dados do formulário
if (isset($_POST["lemail"]) && isset($_POST["lsenha"])){
    $email = $_POST["lemail"];
    $senha = $_POST["lsenha"];
}

// Prepara a instrução SQL usando um prepared statement
$stmt = $conn->prepare("SELECT id, email, senha FROM usuarios WHERE email = ? AND senha = ?");
$stmt->bind_param("ss", $email, $senha);

// Executa a instrução SQL
$stmt->execute();

// Obtém o resultado da consulta
$result = $stmt->get_result();

// Verifica se encontrou um registro com o email e senha fornecidos
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Inicia a sessão e armazena o ID do usuário
        session_start();
        $_SESSION["userid"] = $row["id"];
        echo "Usuário logado com sucesso, ID: " . $_SESSION["userid"]. "<br>";
    }
    // Redireciona para a página de compras se o login for bem-sucedido
    header('location:favoritos.html');
} else {
    // Redireciona para a página de erro se o login falhar
   header('location:erro.html');
}

// Fecha o prepared statement
$stmt->close();

?>