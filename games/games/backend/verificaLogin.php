<?php 
session_start();

if (isset($_SESSION["id"])) {
} else {
header("Location: /games/games/public/login.php");
exit();
}


?>