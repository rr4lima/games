<?php 
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/login.php");
    exit;
}


require_once "../includes/auth.php";
require_once "../includes/conexao.php";
include "../includes/header.php";

$sql = "SELECT * FROM noticias WHERE autor_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['usuario']]);

$noticias = $stmt->fetchAll();
?>

<h2>Minhas Notícias</h2>

<a href="novaNoticia.php">+ Nova Notícia</a>

<?php foreach ($noticias as $n): ?>
    <div>
        <h3><?= $n['titulo'] ?></h3>

        <a href="editarNoticia.php?id=<?= $n['id'] ?>">Editar</a>
        <a href="excluirNoticia.php?id=<?= $n['id'] ?>">Excluir</a>
    </div>
<?php endforeach; ?>











?>