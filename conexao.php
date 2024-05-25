<?php
function parse_database_url($url) {
    $parsed_url = parse_url($url);
    
    return [
        'host' => $parsed_url['host'],
        'port' => $parsed_url['port'],
        'user' => $parsed_url['user'],
        'pass' => $parsed_url['pass'],
        'dbname' => ltrim($parsed_url['path'], '/')
    ];
}

$database_url = getenv('postgresql://postgres:ZViGntZgSRsLLwwVzZFXAtMMGEeGTSso@roundhouse.proxy.rlwy.net:29734/railway');
$db_info = parse_database_url($database_url);

$conn = new mysqli($db_info['host'], $db_info['user'], $db_info['pass'], $db_info['dbname'], $db_info['port']);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
