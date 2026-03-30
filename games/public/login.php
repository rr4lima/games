<?php
require_once "../backend/conexao.php";
session_start();

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario'] = $user['id'];
        header("Location: ../adm/dashboard.php");
    } else {
        echo "Login inválido";
    }
}
?>

<form method="POST">
    <input name="email" placeholder="Email"><br>
    <input name="senha" type="password" placeholder="Senha"><br>
    <button>Entrar</button>
</form>

<a href="cadastro.php">Não tem conta? Cadastre-se!</a>