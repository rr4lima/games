<?php
session_start();
include("../backend/conexao.php");

$texto = $_POST['texto'];
$noticia = $_POST['noticia_id'];
$usuario = $_SESSION['usuario_id'];

$conn->query("INSERT INTO comentarios (texto, usuario_id, noticia_id)
              VALUES ('$texto', '$usuario', '$noticia')");

header("Location: noticia.php?id=$noticia");