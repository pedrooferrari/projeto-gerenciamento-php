import tkinter as tk

<?php

include 'conexao.php';  // inclui a conexao

// Captura o POST que veio da REDE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Captura o e-mail para variável EMAIL
    $nome = htmlspecialchars($_POST["nome"]);
    $problema = ($_POST["problema"]);
    
    try{
        $stmt = $pdo->prepare("INSERT INTO chamados_de_suporte (nome,problema) VALUES (:nome,:problema)");
        $stmt->bindParam(':nome',$nome);
        $stmt->bindParam(':problema',$problema);

        $stmt->execute();

        // redirecione para a tela de cadastro.html
        header('Location: ./painel.php?cod=1');
    }catch(PDOException $e){
        header('Location: ./painel.php?cod=2');
    }
    // Anula a conexão por segurança
    $pdo = null;
}
?>


<?