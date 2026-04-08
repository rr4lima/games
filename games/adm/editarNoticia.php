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

    $sql = "UPDATE noticias 
            SET titulo = :titulo, conteudo = :conteudo 
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
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Notícia</title>
</head>

<body>

<h2>Editar Notícia</h2>

<form method="POST">

    <input 
        name="titulo" 
        value="<?= htmlspecialchars($n['titulo']) ?>" 
        placeholder="Título"
    ><br><br>

    <textarea 
        name="conteudo"
        placeholder="Conteúdo"
    ><?= htmlspecialchars($n['conteudo']) ?></textarea><br><br>

    <button type="submit">Atualizar</button>

</form>

</body>
</html>