<?php
require_once("includes/db.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_cliente = $_POST["nome_cliente"];
    $servico_id = $_POST["servico_id"];
    $data_horario = $_POST["data_horario"];

    // Insere cliente na tabela de clientes (se o nome do cliente ainda não existir)
    $stmt = $conn->prepare("SELECT id FROM clientes WHERE nome = ?");
    $stmt->bind_param("s", $nome_cliente);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        $cliente_id = $cliente['id'];
    } else {
        // Se não encontrar, insere um novo cliente
        $stmt = $conn->prepare("INSERT INTO clientes (nome) VALUES (?)");
        $stmt->bind_param("s", $nome_cliente);
        $stmt->execute();
        $cliente_id = $stmt->insert_id;
    }

    // Insere o agendamento na tabela agendamentos
    $sql = "INSERT INTO agendamentos (cliente_id, servico_id, data_horario, status) VALUES (?, ?, ?, 'pendente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $cliente_id, $servico_id, $data_horario);

    if ($stmt->execute()) {
        header("Location: painel.php?sucesso=1");
    } else {
        header("Location: painel.php?erro=1");
    }
    exit();
}
?>
