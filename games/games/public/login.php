<?php
session_start();
require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: index.php");
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
    <link rel="stylesheet" href="/games/games/public/assets/css/login.css?v=<?= time() ?>">
</head>
<body>

<div class="login-container">

    <h2>Portal de Games</h2>
    <p class="subtitle">Acesse sua conta</p>

    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>

    <form method="POST">
        <input name="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <a href="cadastro.php" class="link-cadastro">Não tem conta? Cadastre-se</a>

</div>

</body>
</html>