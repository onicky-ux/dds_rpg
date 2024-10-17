<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema RPG - Painel</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>RPG DDS</h1>
        <nav>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <section class="catalogo">
        <h2>Sistemas RPG</h2>
        <div class="sistema-grid">
            <div class="sistema-item">
                <a href="sistema1.php">
                    <img src="imagens/sistema1.jpg" alt="Sistema 1">
                    <p>Sistema 1</p>
                </a>
            </div>
            <div class="sistema-item">
                <a href="sistema2.php">
                    <img src="imagens/sistema2.jpg" alt="Sistema 2">
                    <p>Sistema 2</p>
                </a>
            </div>
            <div class="sistema-item">
                <a href="sistema3.php">
                    <img src="imagens/sistema3.jpg" alt="Sistema 3">
                    <p>Sistema 3</p>
                </a>
            </div>
            <!-- Adicione mais itens conforme necessário -->
        </div>
    </section>
</body>
</html>
