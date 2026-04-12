<?php
session_start();
require_once "../backend/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$conexao = new Database();
$conn = $conexao->getConnection();

$id_noticia = $_POST['id_noticia'];
$comentario = $_POST['comentario'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "INSERT INTO comentarios (id_noticia, usuario_id, comentario)
        VALUES (:id_noticia, :usuario_id, :comentario)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_noticia', $id_noticia);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->bindParam(':comentario', $comentario);
$stmt->execute();

header("Location: noticia.php?id=" . $id_noticia);
exit;