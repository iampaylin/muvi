<?php
// Configurações de conexão com o banco de dados
$servername = "localhost"; // endereço do servidor MySQL
$username = "root"; // nome de usuário padrão do MySQL no XAMPP
$password = ""; // senha padrão do MySQL no XAMPP (em branco por padrão)
$dbname = "muvidatabase"; // nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>