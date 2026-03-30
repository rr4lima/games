<?php
session_start(); // importante para ver se o usuário está logado

require_once "../backend/conexao.php";

// Conexão
$conexao = new Database();
$conn = $conexao->getConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Portal de Games</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>🎮 Portal de Games</h1>
    <nav>
        <a href="index.php">Início</a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="../adm/dashboard.php">Dashboard</a>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="cadastro.php">Cadastro</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <h2>Últimas Notícias</h2>

    <?php
    // Pega as notícias mais recentes
    $sql = "SELECT n.*, u.nome AS autor_nome 
            FROM noticias n 
            LEFT JOIN usuarios u ON n.autor_id = u.id 
            ORDER BY n.criado_em DESC";

    $noticias = $conn->query($sql);

    if ($noticias->rowCount() > 0):
        foreach ($noticias as $n):
    ?>
        <div class="noticia-card">
            <h3><?= htmlspecialchars($n['titulo']) ?></h3>
            <p><strong>Resumo:</strong> <?= htmlspecialchars($n['resumo']) ?></p>
            <p><strong>Plataforma:</strong> <?= htmlspecialchars($n['plataforma']) ?></p>
            <p><strong>Autor:</strong> <?= htmlspecialchars($n['autor_nome']) ?></p>
            <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></p>
            <a href="noticia.php?id=<?= $n['id'] ?>">Ler mais</a>
        </div>
    <?php
        endforeach;
    else:
        echo "<p>Nenhuma notícia publicada ainda.</p>";
    endif;
    ?>
</main>

<footer>
    <p>© 2026 Portal de Games</p>
</footer>

</body>
</html>