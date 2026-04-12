<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /games/games/public/login.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID inválido";
    exit();
}

$sql = "SELECT * FROM noticias WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$n = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$n) {
    echo "Notícia não encontrada";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM noticias WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: /games/games/adm/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Excluir Notícia</title>

<link rel="stylesheet" href="/games/games/public/assets/css/deletar.css?v=<?= time() ?>">
</head>

<body>

<div class="delete-container">

    <h2>Excluir Notícia</h2>

    <p class="alerta">Tem certeza que deseja excluir?</p>

    <div class="preview">
        <h3><?= htmlspecialchars($n['titulo']) ?></h3>
        <p><?= htmlspecialchars($n['resumo']) ?></p>
    </div>

    <form method="POST">
        <button type="submit" class="btn-excluir">Sim, excluir</button>
    </form>

    <a href="dashboard.php" class="btn-cancelar">Cancelar</a>

</div>

</body>
</html>