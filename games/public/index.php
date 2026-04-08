<?php
require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Portal de Games</title>

    <link rel="stylesheet" href="/games/games/public/assets/css/header.css">
    <link rel="stylesheet" href="/games/games/public/assets/css/index.css">
</head>

<body>

<?php require_once "../includes/header.php"; ?>
<?php require_once "../includes/navbar.php"; ?>

<main>
    <h2 style="text-align:center; margin:20px;">Últimas Notícias</h2>

    <?php
    $sql = "SELECT n.*, u.nome AS autor_nome 
            FROM noticias n 
            LEFT JOIN usuarios u ON n.autor_id = u.id 
            ORDER BY n.criado_em DESC";

    $noticias = $conn->query($sql);

    if ($noticias->rowCount() > 0):
    ?>

    <div class="noticias-grid">

        <?php foreach ($noticias as $n): ?>
            <div class="noticia-card">
                <h3><?= htmlspecialchars($n['titulo']) ?></h3>
                <p><strong>Resumo:</strong> <?= htmlspecialchars($n['resumo']) ?></p>
                <p><strong>Plataforma:</strong> <?= htmlspecialchars($n['plataforma']) ?></p>
                <p><strong>Autor:</strong> <?= htmlspecialchars($n['autor_nome']) ?></p>
                <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></p>
                <a href="noticia.php?id=<?= $n['id'] ?>">Ler mais</a>
            </div>
        <?php endforeach; ?>

    </div>

    <?php else: ?>
        <p style="text-align:center;">Nenhuma notícia publicada ainda.</p>
    <?php endif; ?>

</main>

<footer style="text-align:center; margin-top:40px;">
    <p>© 2026 Portal de Games</p>
</footer>

</body>
</html>