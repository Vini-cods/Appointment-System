<?php
session_start();
require_once("includes/db.php");

if (!isset($_SESSION["cliente_id"])) {
    header("Location: index.php"); // Se não estiver logado, volta para login
    exit();
}

// Busca serviços disponíveis
$sql = "SELECT * FROM servicos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agendar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Bem-vindo, <?php echo $_SESSION["cliente_nome"]; ?>!</h2>
    <h4>Escolha o serviço e agende um horário:</h4>

    <form action="processa_agendamento.php" method="post">
        <div class="mb-3">
            <label>Escolha um serviço:</label>
            <select name="servico_id" class="form-control" required>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Escolha um horário:</label>
            <input type="datetime-local" name="data_horario" class="form-control" required>
        </div>

        <input type="hidden" name="cliente_id" value="<?php echo $_SESSION["cliente_id"]; ?>">

        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>

    <a href="logout.php" class="btn btn-danger mt-3">Sair</a>
</div>
</body>
</html>
