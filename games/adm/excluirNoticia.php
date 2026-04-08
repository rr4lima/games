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

    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    $sql = "DELETE FROM noticias 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':conteudo' => $conteudo,
        ':id' => $id
    ]);


    header("Location: /games/games/adm/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Excluir Notícia</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h2>Excluir Notícia</h2>

    <p>Tem certeza que deseja excluir:</p>
    <strong><?= htmlspecialchars($n['titulo']) ?></strong> <br>
    <strong><?= htmlspecialchars($n['resumo']) ?></strong> <br>
    <strong><?= htmlspecialchars($n['conteudo']) ?></strong> <br>

    <form method="POST" style="margin-top:20px;">
        <button type="submit">Sim, excluir</button>
    </form>

    <a href="dashboard.php" style="display:block; margin-top:15px; text-align:center;">
        Cancelar
    </a>
</div>

</body>
</html>