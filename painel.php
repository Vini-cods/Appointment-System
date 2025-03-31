<?php 
require_once("includes/db.php");

// Consulta os agendamentos
$sql = "SELECT agendamentos.id, clientes.nome AS nome_cliente, servicos.nome AS servico, agendamentos.data_horario
        FROM agendamentos
        JOIN clientes ON agendamentos.cliente_id = clientes.id
        JOIN servicos ON agendamentos.servico_id = servicos.id
        ORDER BY agendamentos.data_horario ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Painel - Salão</title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:rgb(217, 165, 162);">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Salão de beleza: serviços de estética</a>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Agendamentos</h2>
        
        <!-- Botão para adicionar agendamento -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAgendamento">+ Novo Agendamento</button>
        
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome do Cliente</th>
                    <th>Serviço</th>
                    <th>Data e Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome_cliente']; ?></td>
                        <td><?php echo $row['servico']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['data_horario'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para novo agendamento -->
    <div class="modal fade" id="modalAgendamento" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="adicionar_agendamento.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome do Cliente</label>
                            <input type="text" name="nome_cliente" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Serviço</label>
                            <select name="servico_id" class="form-control" required>
                                <?php 
                                $servicos = $conn->query("SELECT * FROM servicos");
                                while ($servico = $servicos->fetch_assoc()) {
                                    echo "<option value='{$servico['id']}'>{$servico['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data e Hora</label>
                            <input type="datetime-local" name="data_horario" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agendar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
