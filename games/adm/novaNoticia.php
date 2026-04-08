<?php
session_start();

$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");

if ($_POST) {

    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $conteudo = $_POST['conteudo'];
    $plataforma = $_POST['plataforma'];

    $sql = "INSERT INTO noticias (titulo, resumo, conteudo, plataforma) 
            VALUES (:titulo, :resumo, :conteudo, :plataforma)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':titulo' => $titulo,
        ':resumo' => $resumo,
        ':conteudo' => $conteudo,
        ':plataforma' => $plataforma
    ]);

    echo "Notícia cadastrada com sucesso!";
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