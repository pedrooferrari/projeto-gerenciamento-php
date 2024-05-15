<?php
session_start();

if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header("Location: index.php");
    exit;
}

include 'conexao.php';

$usuarios = [];

try {
    $stmt = $pdo->query("SELECT email FROM Usuario");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar usuários: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #121212;
            color: #0f0;
        }
        .sidebar {
            width: 250px;
            background-color: #1e1e1e;
            padding: 2a0px;
            box-shadow: 2px 0 5px rgba(0, 255, 0, 0.2);
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0f0;
        }
        .sidebar a {
            color: #0f0;
            text-decoration: none;
            padding: 10px;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .sidebar a:hover {
            background-color: #333;
        }
        .header {
            padding: 20px;
            background-color: #1e1e1e;
            box-shadow: 0 2px 5px rgba(0, 255, 0, 0.2);
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .header .logout {
            background-color: #0f0;
            color: #121212;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .section {
            display: none;
        }
        .section.active {
            display: block;
        }
        .card {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
            margin-bottom: 20px;
        }
        .card h2 {
            margin-top: 0;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #1e1e1e;
            position: absolute;
            bottom: 0;
            width: calc(100% - 250px);
            margin-left: 250px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #0f0;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Painel</h2>
        <a onclick="showSection('dashboard')">Dashboard</a>
        <a onclick="showSection('usuarios')">Usuários</a>
        <a onclick="showSection('configuracoes')">Configurações</a>
        <a onclick="showSection('relatorios')">Relatórios</a>
        <a onclick="showSection('suporte')">Suporte</a>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Bem-vindo, Usuário</h1>
            <a href="cad.php">Cadastre-se agora!</a>
            <!-- Adicionar botão depois -->

        </div>
        <div id="dashboard" class="section active">
            <div class="card">
                <h2>Resumo</h2>
                <p>Informações resumidas sobre o sistema...</p>
            </div>
            <div class="card">
                <h2>Estatísticas do Sistema</h2>
                <p>Gráficos e dados estatísticos...</p>
            </div>
        </div>
        <div id="usuarios" class="section">
            <div class="card">
                <h2>Lista de Usuários</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="1">Nenhum usuário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h2>Adicionar Novo Usuário</h2>
                <form method="post" action="panel.php">
                    <label for="novo_email">Novo E-mail:</label><br>
                    <input type="email" id="novo_email" name="novo_email" required><br><br>
                    <label for="nova_senha">Nova Senha:</label><br>
                    <input type="password" id="nova_senha" name="nova_senha" required><br><br>
                    <button type="submit">Adicionar</button>
                </form>
            </div>
        </div>
        <div id="configuracoes" class="section">
            <div class="card">
                <h2>Configurações do Sistema</h2>
                <p>Ajustes e configurações gerais...</p>
            </div>
            <div class="card">
                <h2>Preferências de Usuário</h2>
                <p>Configurações específicas do usuário...</p>
            </div>
        </div>
        <div id="relatorios" class="section">
            <div class="card">
                <h2>Relatórios Mensais</h2>
                <p>Relatórios detalhados sobre o desempenho...</p>
            </div>
            <div class="card">
                <h2>Histórico de Relatórios</h2>
                <p>Histórico de todos os relatórios gerados...</p>
            </div>
        </div>
        <div id="suporte" class="section">
    <div class="card">
        <h2>Contatar Suporte</h2>
        <p>Por favor, preencha o formulário abaixo para abrir um chamado de suporte:</p>
        <form action="motor_chamado.php" method="post">
            <input type="nome" name="nome" placeholder="Seu email" required> <br>
            <input type="problema" name="problema" placeholder="Seu problema" required><br>
            
            <button type="submit">Abrir Chamado</button>
        </form>
    </div>
    <div class="card">
        <h2>FAQ</h2>
        <p>Perguntas frequentes e respostas...</p>
    </div>
</div>
    </div>
    
    <script>
        function showSection(sectionId) {
            var sections = document.querySelectorAll('.section');
            sections.forEach(function(section) {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }
    </script>

<div class="footer">
        &copy; 2024 TJ Security. Todos os direitos reservados.
    </div>


    
</body>
</html>
