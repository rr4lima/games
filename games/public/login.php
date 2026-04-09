<?php
session_start();
include_once '../backend/conexao.php';

$pdo = new PDO("mysql:host=localhost;dbname=games","root","");

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: ../public/index.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/games/games/public/assets/css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

    <form method="POST">
        <input name="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <button>Entrar</button>
    </form>

    <a href="cadastro.php">Não tem conta? Cadastre-se</a>
</div>

</body>
</html>