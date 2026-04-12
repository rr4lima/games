<?php
session_start();

require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();

$filtro = isset($_GET['plataforma']) ? $_GET['plataforma'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Portal de Games</title>

    <link rel="stylesheet" href="/games/games/public/assets/css/header.css?v=<?= time() ?>">
<link rel="stylesheet" href="/games/games/public/assets/css/index.css?v=<?= time() ?>">
<link rel="stylesheet" href="/games/games/public/assets/css/navbar.css?v=<?= time() ?>">
</head>

<body>

<?php require_once "../includes/header.php"; ?>
<?php require_once "../includes/navbar.php"; ?>

<main>
    <h2 class="titulo-principal">
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
            $sql = "SELECT n.*, u.nome AS autor_nome, j.nome AS jogo_nome
            FROM noticias n
            LEFT JOIN usuarios u ON n.autor_id = u.id
            LEFT JOIN jogos j ON n.jogo_id = j.id
            WHERE n.plataforma = :plataforma";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':plataforma', $filtro);
            $stmt->execute();
            $noticias = $stmt;
        } else {
            $sql = "SELECT n.*, u.nome AS autor_nome, j.nome AS jogo_nome
                    FROM noticias n
                    LEFT JOIN usuarios u ON n.autor_id = u.id
                    LEFT JOIN jogos j ON n.jogo_id = j.id
                    ORDER BY n.criado_em DESC";

            $noticias = $conn->query($sql);
        }

        if ($noticias->rowCount() > 0):
        ?>

        <div class="noticias-grid">

            <?php foreach ($noticias as $n): ?>
                <div class="noticia-card">

        
                    <h3>
                        <a href="noticia.php?id=<?= $n['id'] ?>">
                            <?= htmlspecialchars($n['titulo']) ?>
                        </a>
                    </h3>

                    <p><strong>Resumo:</strong> <?= htmlspecialchars($n['resumo']) ?></p>
                    <p><strong>Plataforma:</strong> <?= htmlspecialchars($n['plataforma']) ?></p>
                    <p><strong>Jogo:</strong> <?= htmlspecialchars($n['jogo_nome']) ?></p>
                    <p><strong>Autor:</strong> <?= htmlspecialchars($n['autor_nome']) ?></p>

                
                    <a href="noticia.php?id=<?= $n['id'] ?>">Ler mais</a>

                </div>
            <?php endforeach; ?>

        </div>

        <?php else: ?>
            <p style="text-align:center;">Nenhuma notícia publicada ainda.</p>
        <?php endif; ?>

    <?php else: ?>

        <div class="filtros">
            <p>
                Você precisa estar logado para ver as notícias.
            </p>

            <a href="/games/games/public/login.php">
                <button id="btnLogin">Fazer login</button>
            </a>
        </div>

    <?php endif; ?>

</main>

<footer>
    <p>© 2026 Portal de Games</p>
</footer>


</body>
</html>