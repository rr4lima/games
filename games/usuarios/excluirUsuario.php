<?php
include(__DIR__ . "/../backend/verificaLogin.php");
include(__DIR__ . "/../backend/conexao.php");
$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");
$id = $_GET['id'];
$id1 = $_SESSION['usuario_id'];


if ($id == $id1) {
    echo "Você não pode excluir sua própria conta!";
    exit;
}

$conn->query("DELETE FROM usuarios WHERE id=$id");

echo "Usuário excluído com sucesso!";


exit;