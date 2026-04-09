<?php
require_once "../backend/conexao.php";
$pdo = new PDO("mysql:host=localhost;dbname=games","root","");

if ($_POST) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senhaProteg = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaProteg
        ]);
        $sucesso = "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        $erro = "Email já está em uso.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/games/games/public/assets/css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Cadastro</h2>

    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
    <?php if(isset($sucesso)) echo "<p class='sucesso'>$sucesso</p>"; ?>

    <form method="POST">
        <input name="nome" placeholder="Nome" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>

        <button>Cadastrar</button>
    </form>

    <a href="login.php">Já possui uma conta? Faça login</a>
</div>

</body>
</html>