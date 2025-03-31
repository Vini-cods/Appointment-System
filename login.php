<?php
session_start();
require_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $cliente = $result->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $cliente["senha"])) {
            $_SESSION["cliente_id"] = $cliente["id"];
            $_SESSION["cliente_nome"] = $cliente["nome"];
            
            // Redireciona para a página de agendamento
            header("Location: agendar.php");
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Email não encontrado!";
    }
}
?>
