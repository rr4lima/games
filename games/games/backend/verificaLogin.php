<?php 
session_start();

if (isset($_SESSION["id"])) {
    // O usuário está logado, continue com a lógica da página
} else {
header("Location: ../backend/login.php");
exit();
}

?>