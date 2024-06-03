<?php
header('Content-Type: application/json');
require_once 'conexao.php';

session_start();

if (!isset($_SESSION['userid'])) {
    echo json_encode(["success" => false, "message" => "Usuário não autenticado."]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Nenhum dado recebido."]);
    exit;
}

$senhaAtual = $data['senhaAtual'];
$novaSenha = $data['novaSenha'];
$userId = $_SESSION['userid'];

// Verifica se os dados foram fornecidos corretamente
if (empty($senhaAtual) || empty($novaSenha)) {
    echo json_encode(["success" => false, "message" => "Senhas não fornecidas corretamente."]);
    exit;
}

// Obtém a senha armazenada no banco de dados
$stmt = $conn->prepare("SELECT senha FROM usuarios WHERE id = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Erro na preparação da consulta: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($senhaHash);
$stmt->fetch();
$stmt->close();

// Verifica se a senha foi encontrada
if (empty($senhaHash)) {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado."]);
    exit;
}

// Verifica a senha atual
if ($senhaAtual !== $senhaHash) {
    echo json_encode(["success" => false, "message" => "Senha atual incorreta."]);
    exit;
}

// Atualiza a senha no banco de dados
$stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Erro na preparação da consulta para atualização: " . $conn->error]);
    exit;
}

$stmt->bind_param("si", $novaSenha, $userId);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Senha alterada com sucesso."]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao alterar a senha."]);
}

$stmt->close();
$conn->close();
?>