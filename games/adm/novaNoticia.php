<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /games/games/public/login.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");

if ($_POST) {

    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];
    $plataforma = $_POST['plataforma'];
    $jogo_nome = $_POST['jogo_nome'];

    $sql = "SELECT id FROM jogos WHERE nome = :nome";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':nome' => $jogo_nome]);
    $jogo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($jogo) {
        $jogo_id = $jogo['id'];
    } else {
        $sql = "INSERT INTO jogos (nome) VALUES (:nome)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':nome' => $jogo_nome]);

        $jogo_id = $conn->lastInsertId();
    }

    $sql = "INSERT INTO noticias (titulo, resumo, conteudo, plataforma, autor_id, jogo_id) 
            VALUES (:titulo, :resumo, :conteudo, :plataforma, :autor_id, :jogo_id)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':resumo' => $resumo,
        ':conteudo' => $conteudo,
        ':plataforma' => $plataforma,
        ':autor_id' => $_SESSION['usuario_id'],
        ':jogo_id' => $jogo_id
    ]);

    header("Location: /games/games/adm/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Nova Notícia</title>

<link rel="stylesheet" href="/games/games/public/assets/css/form.css?v=<?= time() ?>">
</head>

<body>

<div class="form-container">

    <h2>Nova Notícia</h2>

    <form method="POST">

        <input name="titulo" placeholder="Título" required>

        <textarea name="resumo" placeholder="Resumo" required></textarea>

        <textarea name="conteudo" placeholder="Conteúdo" required></textarea>

         <input name="jogo_nome" placeholder="Nome do jogo" required>

        <select name="plataforma" required>
          <option value="">Selecione a plataforma</option>
            <option value="PC">PC</option>
            <option value="PlayStation">PlayStation</option>
            <option value="Xbox">Xbox</option>
        </select>  
</select>

        <button type="submit">Publicar</button>

    </form>

    <a href="/games/games/adm/dashboard.php" class="btn-voltar">← Voltar</a>

</div>

</body>
</html>