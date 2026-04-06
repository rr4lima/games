<?php
require_once '../backend/verificaLogin.php';
session_start();

if ($_POST) {
    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];
    $plataforma = $_POST['plataforma'];
}

$sql = "INSERT INTO noticias (titulo, resumo, conteudo, plataforma, autor_id) 
VALUES (:titulo, :resumo, :conteudo, :plataforma, :autor_id)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':titulo' => $titulo,
    ':resumo' => $resumo,
    ':conteudo' => $conteudo,
    ':plataforma' => $plataforma,
    ':autor_id' => $_SESSION['usuario_id']
]);
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