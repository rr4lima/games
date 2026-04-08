<?php
session_start();



$id = $_GET['id'];

$res = $conn->query("SELECT * FROM noticias WHERE id=$id");
$n = $res->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    $conn->query("UPDATE noticias SET titulo='$titulo', conteudo='$conteudo' WHERE id=$id");
}
?>

<form method="POST">
    <input name="titulo" value="<?= $n['titulo'] ?>"><br>
    <textarea name="conteudo"><?= $n['conteudo'] ?></textarea><br>
    <button>Atualizar</button>
</form>
