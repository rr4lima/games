<nav class="navbar">
    <a href="/games/games/public/index.php">Início</a>

    <?php if(!isset($_SESSION['usuario_id'])): ?>
        <a href="/games/games/public/login.php">Login</a>
        <a href="/games/games/public/cadastro.php">Cadastrar</a>
    <?php else: ?>
        <a href="/games/games/adm/dashboard.php">Dashboard</a>
        <a href="/games/games/public/logout.php">Sair</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="/games/games/public/editarConta.php">Editar Conta</a>
        <a href="/games/games/public/excluirConta.php" onclick="return confirm('Tem certeza que deseja excluir sua conta?')">
            Excluir Conta
        </a>
    <?php endif; ?>

</nav>