<?php
include("../backend/conexao.php");

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM noticias WHERE id=$id");
$n = $res->fetch_assoc();

echo "<h1>".$n['titulo']."</h1>";
echo "<p>".$n['conteudo']."</p>";

$comentarios = $conn->query("SELECT * FROM comentarios WHERE noticia_id=$id");

while($c = $comentarios->fetch_assoc()){
    echo "<p>".$c['texto']."</p>";
}
?>

<form method="POST" action="comentar.php">
    <input type="hidden" name="noticia_id" value="<?= $id ?>">
    <textarea name="texto"></textarea>
    <button>Comentar</button>
</form>