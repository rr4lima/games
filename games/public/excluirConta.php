<?php
session_start();
require_once "../backend/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$conexao = new Database();
$conn = $conexao->getConnection();

$id = $_SESSION['usuario_id'];

// 🔥 DELETA USUÁRIO
$sql = "DELETE FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$_SESSION = []; 

session_destroy();

session_start();
session_regenerate_id(true);

header("Location: index.php");
exit;