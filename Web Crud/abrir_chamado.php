<?php
// Conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $problema = $_POST["problema"];

    // Insere os dados na tabela de chamados de suporte
    try {
        $stmt = $pdo->prepare("INSERT INTO chamados_suporte (nome, problema) VALUES (:nome, :problema)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':problema', $problema);
        $stmt->execute();

        echo "Chamado de suporte aberto com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao abrir chamado de suporte: " . $e->getMessage();
    }
}
?>
