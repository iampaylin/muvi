<?php
header('Content-Type: application/json');
require_once 'conexao.php'; // Arquivo que contém a conexão com o banco de dados

$data = json_decode(file_get_contents('php://input'), true);

$userId = $data['userId'];
$movieId = $data['movieId'];
$title = $data['title'];
$genres = $data['genres'];
$posterPath = $data['posterPath'];

if ($userId && $movieId && $title && $genres && $posterPath) {
    $stmt = $conn->prepare("INSERT INTO favorites (user_id, movie_id, title, genres, poster_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $userId, $movieId, $title, $genres, $posterPath);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao adicionar filme aos favoritos.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}

$conn->close();
?>