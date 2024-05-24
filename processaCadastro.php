<?php
// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão com o banco de dados
    require_once "conexao.php";

    // Função para validar e sanitizar dados
    function test_input($data) {
        $data = trim($data); // Remove espaços em branco no início e no fim
        $data = stripslashes($data); // Remove barras invertidas adicionadas por addslashes
        $data = htmlspecialchars($data); // Converte caracteres especiais em entidades HTML
        return $data;
    }

    // Recebe e sanitiza os dados do formulário
    $nome_sobrenome = test_input($_POST["cname"]);
    $senha = test_input($_POST["csenha"]);
    $apelido = test_input($_POST["capelido"]);
    $email = test_input($_POST["cemail"]);
    $data_nascimento = test_input($_POST["cnasc"]);

    // Prepara a instrução SQL usando um prepared statement
    $stmt = $conn->prepare("INSERT INTO usuarios (nome_sobrenome, senha, apelido, email, data_nascimento) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome_sobrenome, $senha, $apelido, $email, $data_nascimento);

    // Executa a instrução SQL
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    // Fecha o prepared statement
    $stmt->close();

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
