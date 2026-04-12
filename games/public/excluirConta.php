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

// 🔥 DESTRÓI COMPLETAMENTE A SESSÃO
$_SESSION = []; // limpa variáveis

session_destroy();

// 🔥 GARANTE que não fica logado (evita bug)
session_start();
session_regenerate_id(true);

// 🔥 REDIRECIONA DESLOGADO
header("Location: index.php");
exit;