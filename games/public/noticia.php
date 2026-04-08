<?php
include("../backend/verificaLogin.php");

$pdo = new PDO("mysql:host=localhost;dbname=games", "root", "");

$sql = "SELECT * FROM usuarios";
$res = $pdo->query($sql);
?>

<h1>Usuários</h1>

<?php while ($u = $res->fetch(PDO::FETCH_ASSOC)): ?>

    <div class="card">
        <p><strong>Nome:</strong> <?= $u['nome'] ?></p>
        <p><strong>Email:</strong> <?= $u['email'] ?></p>

        <a href="../usuarios/editarUsuario.php?id=<?= $u['id'] ?>">Editar</a>
        <a href="../usuarios/excluirUsuario.php?id=<?= $u['id'] ?>">Excluir</a>
    </div>

<?php endwhile; ?>