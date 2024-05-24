<?php
header('Content-Type: application/json');
require_once 'conexao.php'; // Arquivo que contém a conexão com o banco de dados

session_start(); // Inicia a sessão

if (isset($_SESSION["userid"])) {
    $userId = $_SESSION["userid"]; // ID do usuário autenticado

    $stmt = $conn->prepare("SELECT movie_id, title, genres, poster_path FROM favorites WHERE user_id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $favorites = [];

        while ($row = $result->fetch_assoc()) {
            $favorites[] = $row;
        }

        echo json_encode($favorites);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao recuperar filmes favoritos.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
}
?>