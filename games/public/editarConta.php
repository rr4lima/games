<?php
session_start();
require_once "../backend/conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$conexao = new Database();
$conn = $conexao->getConnection();

$id = $_SESSION['usuario_id'];

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $sucesso = "Conta atualizada com sucesso!";
}

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Conta</title>

<link rel="stylesheet" href="/games/games/public/assets/css/form.css?v=<?= time() ?>">
</head>

<body>

<div class="form-container">

    <h2>Editar Conta</h2>

    <?php if(isset($sucesso)) echo "<p class='sucesso'>$sucesso</p>"; ?>

    <form method="POST">

        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <button type="submit">Salvar</button>

    </form>

    <a href="index.php" class="btn-voltar">← Voltar</a>

</div>

</body>
</html>