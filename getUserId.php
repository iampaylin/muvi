<?php
session_start();

if(isset($_SESSION["userid"])) {
    echo json_encode(['success' => true, 'userId' => $_SESSION["userid"]]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
}
?>