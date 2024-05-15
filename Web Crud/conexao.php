<?php
$host = "localhost"; // Endereço do servidor de banco de dados
$dbname = "loginprocedural"; // Nome do banco de dados
$usuario = "root"; // Usuário do banco de dados
$senha = ""; // Senha do banco de dados

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Criação de uma nova instância de PDO
    $pdo = new PDO($dsn, $usuario, $senha);
    
    // Define o modo de erro e o modo de busca padrão
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Verifica se a conexão foi estabelecida com sucesso
    if ($pdo) {
        echo "On!";
    } else {
        echo "Falha ao conectar ao banco de dados!";
    }
} catch(PDOException $e) {
    // Captura exceções do tipo PDOException e exibe uma mensagem de erro
    die("Erro de conexão: " . $e->getMessage());
}
?>
