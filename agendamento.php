<?php
require_once "includes/db.php";

// Verifica se o serviço foi selecionado via GET
if (!isset($_GET['servico'])) {
    die("Serviço não selecionado.");
}

$servico_id = intval($_GET['servico']);

// Busca informações do serviço na tabela 'servicos'
$sql = "SELECT * FROM servicos WHERE id = $servico_id";
$result = $conn->query($sql);
$servico = $result->fetch_assoc();

// Verifica se o serviço existe
if (!$servico) {
    die("Serviço não encontrado.");
}

// Processa agendamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $telefone = $_POST["telefone"];
    $data_horario = $_POST["data_horario"];

    // Insere cliente na tabela clientes
    $conn->query("INSERT INTO clientes (nome, telefone) VALUES ('$cliente', '$telefone')");
    $cliente_id = $conn->insert_id;

    // Insere o agendamento na tabela agendamentos
    $conn->query("INSERT INTO agendamentos (cliente_id, servico_id, data_horario) VALUES ($cliente_id, $servico_id, '$data_horario')");

    echo "Agendamento realizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Agendar Serviço</h1>
    <h2><?= htmlspecialchars($servico['nome']) ?></h2>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="cliente" required>
        
        <label>Telefone:</label>
        <input type="text" name="telefone" required>
        
        <label>Data e Horário:</label>
        <input type="datetime-local" name="data_horario" required>
        
        <button type="submit">Agendar</button>
        <button type="button" onclick="window.location.href='index.php'">Voltar</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
<?php
