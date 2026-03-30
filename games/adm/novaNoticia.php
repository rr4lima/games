<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/login.php");
    exit;
}

require_once "../includes/auth.php";
require_once "../includes/conexao.php";

if ($_POST) {

    $sql = "INSERT INTO noticias (titulo, resumo, conteudo, plataforma, autor_id)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['titulo'],
        $_POST['resumo'],
        $_POST['conteudo'],
        $_POST['plataforma'],
        $_SESSION['usuario']
    ]);

    header("Location: dashboard.php");
}
?>

<form method="POST">
    <input name="titulo" placeholder="Título"><br>
    <textarea name="resumo"></textarea><br>
    <textarea name="conteudo"></textarea><br>

    <select name="plataforma">
        <option>PC</option>
        <option>PS5</option>
        <option>Xbox</option>
    </select>

    <button>Publicar</button>
</form>

