<?php
header('Content-Type: application/json');
require_once 'conexao.php'; // Arquivo que contém a conexão com o banco de dados

session_start(); // Inicia a sessão

if (!isset($_SESSION['userid'])) {
    echo json_encode(["status" => "error", "message" => "Usuário não autenticado."]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $movieId = $input['movieId'];
    $userId = $_SESSION['userid'];

    $stmt = $conn->prepare("DELETE FROM favorites WHERE movie_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $movieId, $userId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao remover o filme."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método de requisição inválido."]);
}
?>