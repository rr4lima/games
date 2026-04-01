<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/public/assets/css/style.css">
<title>Portal Games</title>
</head>
<body>

<header>
    <h1>Portal de Games</h1>

    <nav>
        <a href="/public/index.php">Início</a>

        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="/adm/dashboard.php">Dashboard</a>
            <a href="/public/logout.php">Sair</a>
        <?php else: ?>
            <a href="/public/login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>