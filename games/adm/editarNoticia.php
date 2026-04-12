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
    $resumo = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];

    $sql = "UPDATE noticias 
            SET titulo = :titulo, resumo = :resumo, conteudo = :conteudo 
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':resumo' => $resumo,
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

    <link rel="stylesheet" href="/games/games/public/assets/css/form.css?v=<?= time() ?>">
</head>

<body>

<div class="form-container">

    <h2>Editar Notícia</h2>

    <form method="POST">

        <input 
            name="titulo" 
            value="<?= htmlspecialchars($n['titulo']) ?>" 
            placeholder="Título"
            required
        >

        <textarea 
            name="resumo"
            placeholder="Resumo"
            required
        ><?= htmlspecialchars($n['resumo']) ?></textarea>

        <textarea 
            name="conteudo"
            placeholder="Conteúdo"
            required
        ><?= htmlspecialchars($n['conteudo']) ?></textarea>

        <button type="submit">Atualizar</button>

    </form>

</div>

</body>
</html>