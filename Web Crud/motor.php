import tkinter as tk

<?php

include 'conexao.php';  // inclui a conexao

// Captura o POST que veio da REDE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Captura o e-mail para variável EMAIL
    $email = htmlspecialchars($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    

    try{
        $stmt = $pdo->prepare("INSERT INTO Usuario (email,senha) VALUES (:email,:senha)");
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':senha',$senha);

        $stmt->execute();

        // redirecione para a tela de cadastro.html
        header('Location: ./cad.php?cod=1');
    }catch(PDOException $e){
        header('Location: ./cad.php?cod=2');
    }
    // Anula a conexão por segurança
    $pdo = null;
}
?>


<?