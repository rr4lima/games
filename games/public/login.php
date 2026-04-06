<?php
session_start();
include_once '../backend/conexao.php';
$pdo = new PDO("mysql:host=localhost;dbname=games","root","");
if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: ../public/index.php");
    } else {
        echo "Erro no login";
    }
}

?>
<form method="POST">
    <input name="email" placeholder="Email"><br>
    <input name="senha" type="password" placeholder="Senha"><br>
    <button>Entrar</button>
</form>
<a href="cadastro.php">Não tem conta? Cadastre-se!</a>