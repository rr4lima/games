<?php
require_once "../backend/conexao.php";

$conexao = new Database();
$conn = $conexao->getConnection();

if ($_POST) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senhaProteg = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $conn->prepare($sql);

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
    <link rel="stylesheet" href="/games/games/public/assets/css/login.css?v=<?= time() ?>">
</head>
<body>

<div class="login-container">

    <h2>Portal de Games</h2>
    <p class="subtitle">Crie sua conta</p>

    <?php if(isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
    <?php if(isset($sucesso)) echo "<p class='sucesso'>$sucesso</p>"; ?>

    <form method="POST">
        <input name="nome" placeholder="Nome" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="login.php" class="link-cadastro">Já possui uma conta? Faça login</a>

</div>

</body>
</html>