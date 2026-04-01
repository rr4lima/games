<?php 
session_start();

if (isset($_SESSION["usuario_id"])) {
header("Location: ../backend/login.php");
exit();
}

?>