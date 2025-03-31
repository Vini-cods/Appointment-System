<?php
session_start();
require_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST["cliente_id"];
    $servico_id = $_POST["servico_id"];
    $data_horario = $_POST["data_horario"];

    $sql = "INSERT INTO agendamentos (cliente_id, servico_id, data_horario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $cliente_id, $servico_id, $data_horario);
    
    if ($stmt->execute()) {
        echo "Agendamento realizado com sucesso!";
        header("refresh:2; url=agendar.php"); // Redireciona após 2 segundos
    } else {
        echo "Erro ao agendar!";
    }
}
?>
