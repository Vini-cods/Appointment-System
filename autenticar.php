<?php 
session_start();
require_once("conexao.php"); // Certifique-se de que esse arquivo define $pdo

// Obtenção dos Dados do Formulário.
$email = $_POST['email'];
$senha = $_POST['senha'];

// Verificação das Credenciais no banco de dados.
$query = $pdo->prepare("SELECT * FROM config WHERE email = :email AND senha = :senha");
$query->bindParam(':email', $email);
$query->bindParam(':senha', $senha);
$query->execute();
$res = $query->fetch(PDO::FETCH_ASSOC);

if ($res) {
    $_SESSION['nome'] = $res['nome'];
    header("Location: painel.php");
exit;

} else {
    echo '<script>alert("Dados Incorretos")</script>';
    echo '<script>window.location="index.php"</script>';
}

// Verifica se os campos foram preenchidos
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Prepara a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT nome, senha FROM clientes WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nome, $senha_hash);
        $stmt->fetch();
        
        // Verifica a senha
        if (password_verify($senha, $senha_hash)) {
            $_SESSION['nome'] = $nome;
            echo '<script>window.location="painel.php"</script>';
        } else {
            echo '<script>alert("Senha incorreta!");window.location="index.php";</script>';
        }
    } else {
        echo '<script>alert("Usuário não encontrado!");window.location="index.php";</script>';
    }
    
    $stmt->close();
} else {
    echo '<script>alert("Preencha todos os campos!");window.location="index.php";</script>';
}

$conn->close();
