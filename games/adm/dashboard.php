<?php
require_once '../backend/verificaLogin.php';
session_start();
include 'backend/conexao.php';

$id = $_POST['usuario_id'];

$sql = "SELECT * FROM noticias WHERE autor_id = $id";
$res = $conn->query($sql);

while ($n = $res->fetch(PDO::FETCH_ASSOC)) {
    echo $n['titulo'];
    echo "<a href='editar_noticia.php?id=".$n['id']."'>Editar</a>";
    echo "<a href='excluir_noticia.php?id=".$n['id']."'>Excluir</a>";
}
?>