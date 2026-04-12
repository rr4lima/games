<?php
session_start();
require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];


$sql = "SELECT n.*, j.nome AS jogo_nome, u.nome AS autor_nome
        FROM noticias n
        LEFT JOIN jogos j ON n.jogo_id = j.id
        LEFT JOIN usuarios u ON n.autor_id = u.id
        WHERE n.id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$noticia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$noticia) {
    echo "Notícia não encontrada.";
    exit;
}

$sqlComentarios = "SELECT c.*, u.nome 
                   FROM comentarios c
                   JOIN usuarios u ON c.usuario_id = u.id
                   WHERE c.id_noticia = :id
                   ORDER BY c.criado_em DESC";

$stmtComentarios = $conn->prepare($sqlComentarios);
$stmtComentarios->bindParam(':id', $id);
$stmtComentarios->execute();
$comentarios = $stmtComentarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($noticia['titulo']) ?></title>

    <link rel="stylesheet" href="/games/games/public/assets/css/header.css?v=<?= time() ?>">
<link rel="stylesheet" href="/games/games/public/assets/css/navbar.css?v=<?= time() ?>">
<link rel="stylesheet" href="/games/games/public/assets/css/noticia.css?v=<?= time() ?>">
</head>

<body>

<?php require_once "../includes/header.php"; ?>
<?php require_once "../includes/navbar.php"; ?>

<main style="max-width:800px; margin:auto;">

    <h1><?= htmlspecialchars($noticia['titulo']) ?></h1>

    <p><strong>Autor:</strong> <?= htmlspecialchars($noticia['autor_nome']) ?></p>
    <p><strong>Jogo:</strong> <?= htmlspecialchars($noticia['jogo_nome']) ?></p>
    <p><strong>Plataforma:</strong> <?= htmlspecialchars($noticia['plataforma']) ?></p>

    <hr>

    <p><?= nl2br(htmlspecialchars($noticia['conteudo'])) ?></p>

    <hr>

    <h3>Comentários</h3>

    <?php if (count($comentarios) > 0): ?>
        <?php foreach ($comentarios as $c): ?>
            <div class="comentario">
                 <strong><?= htmlspecialchars($c['nome']) ?></strong>
                  <p><?= htmlspecialchars($c['comentario']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Ninguém comentou ainda.</p>
    <?php endif; ?>

    <hr>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <form action="comentar.php" method="POST">
            <input type="hidden" name="id_noticia" value="<?= $id ?>">

            <textarea name="comentario" required placeholder="Escreva um comentário"></textarea><br><br>

            <button type="submit">Comentar</button>
        </form>
    <?php else: ?>
        <p>Faça login para comentar.</p>
    <?php endif; ?>

</main>

</body>
</html>