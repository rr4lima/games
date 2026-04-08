<?php
require_once '../backend/verificaLogin.php';
include_once 'backend/conexao.php';
session_start();

if (!isset($_POST['usuario'])) {
    header("Location: /public/login.php");
    exit;
}

$id = $_GET["id"];

$conn->query("DELETE FROM noticias 
WHERE id = $id");

header("Location: ../adm/dashboard.php");
exit;
?>