<?php
session_start();
require_once "../backend/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /games/games/adm/novaNoticia.php");
    exit();
}

$conexao = new Database();
$conn = $conexao->getConnection();

$sql = "SELECT * FROM noticias ORDER BY criado_em DESC";
$noticias = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="/games/games/public/assets/css/header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/games/games/public/assets/css/index.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/games/games/public/assets/css/navbar.css?v=<?= time() ?>">
    </head>

<body>

    <?php require_once "../includes/header.php"; ?>
    <?php require_once "../includes/navbar.php"; ?>

    <main>

        <div class="top-actions">
            <a href="/games/games/adm/novaNoticia.php" class="btn-nova">+ Nova Notícia</a>
        </div>

        <div class="noticias-grid">

            <?php foreach ($noticias as $n): ?>
                <div class="noticia-card">

                    <h3><?= htmlspecialchars($n['titulo']) ?></h3>

                    <p><?= htmlspecialchars($n['resumo']) ?></p>

                    <p><strong>Plataforma:</strong> <?= $n['plataforma'] ?></p>

                    <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($n['criado_em'])) ?></p>

                    <div class="card-actions">
                        <a href="editarNoticia.php?id=<?= $n['id'] ?>" class="btn-editar">Editar</a>
                        <a href="excluirNoticia.php?id=<?= $n['id'] ?>" class="btn-excluir">Excluir</a>
                        <div id="listaNoticias"></div>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    </main>

</body>

</html>