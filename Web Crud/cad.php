<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    
    , initial-scale=1.0">
    <title>Cadastrar</title>
    
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: black;
            color: #0f0;
            margin: 0;
        }
        .container {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #0f0;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #0f0;
        }
        button {
            background-color: #0f0;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0a0;
        }
        a {
            color: #0f0;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<div class="container">

<h2>Cadastro</h2>
    <form action="motor.php" method="post">  
        <input type="email" name="email" placeholder="Email" required> <br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">  Registrar  </button>

        <a href="index.html">Logue agora!</a>
    </form>

</div>
    
    <?php

    // Capturar a URL e o Código 
    if(isset($_GET['cod']))
    {
        $codigo = filter_var($_GET["cod"], FILTER_SANITIZE_NUMBER_INT);
    if($codigo == 1)
    {
        echo "Cadastrado com sucesso!";

    }else{
        echo "Deu ruim! Cadastro mal-sucedido." ;
    }

    }

    ?>

</body>
</html>