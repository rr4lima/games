<?php

require_once "../backend/conexao.php";
require_once "../includes/navbar.php";
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
    <h1>Games</h1>
    
</header>

<main>
    <h2>Últimas Notícias</h2>
    <?php
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
    <link rel="stylesheet" href="assets/css/style.css">
</footer>

</body>
</html>