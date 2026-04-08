<nav class="navbar">
    <a href="/games/games/public/index.php">Início</a>

<?php if(!isset($_SESSION['usuario_id'])): ?>
    <a href="/games/games/public/login.php">Login</a>
    <a href="/games/games/public/cadastro.php">Cadastrar</a>
<?php else: ?>
    <a href="/games/games/adm/dashboard.php">Dashboard</a>
    <a href="/games/games/public/logout.php">Sair</a>
<?php endif; ?>
</nav>