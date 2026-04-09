<?php
session_start();

require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();

// 🆕 FILTRO POR JOGO (plataforma)
$filtro = isset($_GET['plataforma']) ? $_GET['plataforma'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Portal de Games</title>

    <link rel="stylesheet" href="/games/games/public/assets/css/header.css">
    <link rel="stylesheet" href="/games/games/public/assets/css/index.css">
    <link rel="stylesheet" href="/games/games/public/assets/css/navbar.css">
</head>

<body>

<?php require_once "../includes/header.php"; ?>
<?php require_once "../includes/navbar.php"; ?>

<main>
    <h2 style="text-align:center; margin:20px;">
        Últimas Notícias
    </h2>
  

    <?php if (isset($_SESSION['usuario_id'])): ?>


    <div style="text-align:center; margin-bottom:20px;">
        <a href="index.php">Todas</a> |
        <a href="index.php?plataforma=PC">PC</a> |
        <a href="index.php?plataforma=PlayStation">PlayStation</a> |
        <a href="index.php?plataforma=Xbox">Xbox</a>
    </div>

        <?php
        if ($filtro) {
            $sql = "SELECT n.*, u.nome AS autor_nome 
                    FROM noticias n 
                    LEFT JOIN usuarios u ON n.autor_id = u.id 
                    WHERE n.plataforma = :plataforma
                    ORDER BY n.criado_em DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':plataforma', $filtro);
            $stmt->execute();
            $noticias = $stmt;
        } else {
            $sql = "SELECT n.*, u.nome AS autor_nome 
                    FROM noticias n 
                    LEFT JOIN usuarios u ON n.autor_id = u.id 
                    ORDER BY n.criado_em DESC";

            $noticias = $conn->query($sql);
        }

        if ($noticias->rowCount() > 0):
        ?>

        <div class="noticias-grid">

            <?php foreach ($noticias as $n): ?>
                <div class="noticia-card">

                    <!-- 🆕 título clicável -->
                    <h3>
                        <a href="noticia.php?id=<?= $n['id'] ?>">
                            <?= htmlspecialchars($n['titulo']) ?>
                        </a>
                    </h3>

                    <p><strong>Resumo:</strong> <?= htmlspecialchars($n['resumo']) ?></p>
                    <p><strong>Plataforma:</strong> <?= htmlspecialchars($n['plataforma']) ?></p>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($n['autor_nome']) ?></p>
                    <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></p>

                    <!-- já tinha, mantido -->
                    <a href="noticia.php?id=<?= $n['id'] ?>">Ler mais</a>

                </div>
            <?php endforeach; ?>

        </div>

        <?php else: ?>
            <p style="text-align:center;">Nenhuma notícia publicada ainda.</p>
        <?php endif; ?>

    <?php else: ?>

        <div style="text-align:center; margin:40px;">
            <p style="font-size:18px; margin-bottom:20px;">
                Você precisa estar logado para ver as notícias.
            </p>

            <a href="/games/games/public/login.php">
                <button id="btnLogin">Fazer login</button>
            </a>
        </div>

    <?php endif; ?>

</main>

<footer style="text-align:center; margin-top:40px;">
    <p>© 2026 Portal de Games</p>
</footer>

</body>
</html>