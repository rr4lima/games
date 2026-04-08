<?php
include(__DIR__ . "/../backend/verificaLogin.php");
include(__DIR__ . "/../backend/conexao.php");
$conn = new PDO("mysql:host=localhost;dbname=games", "root", "");
// Verifica se ID existe
if (!isset($_GET['id'])) {
    die("ID não informado");
}

$id = intval($_GET['id']); // segurança básica

// Testa conexão
if (!$conn) {
    die("Erro na conexão com o banco");
}

// Buscar usuário

$sql = "SELECT * FROM usuarios WHERE id=$id";
$res = $conn->query($sql);

// Verifica se deu erro na query
if (!$res) {
    die("Erro na query: " . $conn->error);
}

$u = $res->fetch(PDO::FETCH_ASSOC);

// Verifica se encontrou usuário
if (!$u) {
    die("Usuário não encontrado");
}

// Atualizar
if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $conn->query("UPDATE usuarios 
                      SET nome='$nome', email='$email', senha='$senha' 
                      WHERE id=$id");
    } else {
        $conn->query("UPDATE usuarios 
                      SET nome='$nome', email='$email' 
                      WHERE id=$id");
    }

    header("Location: ../public/usuarios.php");
    exit;
}
?>

<h1>Editar Usuário</h1>

<form method="POST">
    Nome:
    <input name="nome" value="<?= $u['nome'] ?>"><br>

    Email:
    <input name="email" value="<?= $u['email'] ?>"><br>

    Senha (deixe vazio para não alterar):
    <input type="password" name="senha"><br>

    <button>Atualizar</button>
</form>