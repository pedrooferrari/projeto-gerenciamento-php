<?php

include 'conexao.php';
/* Se existir uma requisição da página index.php do tipo POST 
Buscar no banco de dados se esse usuário existe, se existir logar e enviar para a pagina Painel, senão não logar. */

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $email = htmlspecialchars($_POST["email"]);
    $senha = $_POST['senha'];

    try{
        $stmt = $pdo->prepare('Select * from usuario where email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if($usuario)
        {
            if(password_verify($senha, $usuario['senha']))
            {

                session_start();
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_logado'] = true;
                header("location: painel.php");
            }
            else{
                echo "Senha Incorreta";
                echo "<a href='index.html' >Voltar para tela Anterior </a>";
            }
        }else{
            echo "Usuário não encontrado !";
        }

    }catch(PDOException $e) {
        echo "Erro no login:". $e->getMessage();
    }
}

?>
<?