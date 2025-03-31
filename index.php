<?php 
require_once("includes/db.php");
$sql = "SELECT * FROM servicos"; // Modificado para buscar os serviços da tabela 'servicos'
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Salão</title>
	<meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/salao.ico">
</head>
<body>

	<section class="vh-100" style="background-color:rgb(217, 165, 162)">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card shadow-2-strong" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">
							
							<img src="img/salao.png" width="250px" style="margin-bottom: 25px">

							<!-- Formulário de Login -->
							<form method="post" action="autenticar.php">
								<div class="form-outline mb-4">
									<input name="email" type="email" id="typeEmailX-2" class="form-control" placeholder="Email" required/>
								</div>

								<div class="form-outline mb-4">
									<input name="senha" type="password" id="typePasswordX-2" class="form-control" placeholder="Senha" required/>
								</div>

								<div class="d-grid gap-2">
									<button class="btn btn-primary" type="submit">Login</button>
								</div>
							</form>

							<hr class="my-4">
							<div align="center"><small><a href="#" data-bs-toggle="modal" data-bs-target="#modalRecuperar">Recuperar Senha</a></small></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Seção de Serviços Disponíveis para Agendamento -->
	<section class="container mt-5">
		<h2 class="text-center">Serviços Disponíveis</h2>
		<div class="row">
			<?php while ($servico = $result->fetch_assoc()) { ?>
				<div class="col-md-4 mb-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"><?= htmlspecialchars($servico['nome']) ?></h5>
							<p class="card-text"><?= htmlspecialchars($servico['descricao']) ?></p>
							<p class="card-text"><strong>Preço: R$ <?= number_format($servico['preco'], 2, ',', '.') ?></strong></p>
							<a href="agendamento.php?servico=<?= $servico['id'] ?>" class="btn btn-primary">Agendar</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>

</body>
</html>

<?php $conn->close(); ?>
