<?php session_start(); ?>

<div class="navbar">
    <a href="index.php">Início</a>

    <?php if(!isset($_SESSION['usuario_id'])): ?>
        <a href="login.php">Login</a>
        <a href="cadastro.php">Cadastrar</a>
    <?php else: ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Sair </a>
    <?php endif; ?>
</div>