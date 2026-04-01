<h2>Cadastro</h2>

<form method="POST">
    <input name="nome" placeholder="Nome" required><br><br>
    <input name="email" type="email" placeholder="Email" required><br><br>
    <input name="senha" type="password" placeholder="Senha" required><br><br>

    <button>Cadastrar</button>
</form>

<a href="login.php">Já possui uma conta? Faça login!</a>
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
        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: email já pode estar em uso.";
    }
}
?>