<?php

$usuario = 'root';
$senha = '';
$banco = 'salao';
$servidor = 'localhost';

date_default_timezone_set('America/Sao_Paulo');

try {
    $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
    die('Erro ao conectar com o Banco de Dados!');
}

// Verificar se existem dados na tabela config
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (count($res) == 0) {
    $pdo->query("INSERT INTO config SET nome = 'Salão', email = 'vinisenai177@gmail.com', senha = '123', telefone = '(11)913105016', endereco = '', logo = 'logo.png', icone = 'icone.png', cor = '#00c1c1', titulo_contato = 'Contate-nos', subtitulo_contato = 'Preencha os Campos abaixo para entrar em contato conosco!'");
} else {
    $nome_sistema = $res[0]['nome'];
    $email_sistema = $res[0]['email'];
}

// Verificar se a tabela 'sobre' existe antes de tentar acessá-la
try {
    $query = $pdo->query("SELECT * FROM sobre");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) == 0) {
        $pdo->query("INSERT INTO sobre SET titulo = 'Sobre', subtitulo = 'Subtitulo caso Exista', descricao = 'Descrição da página Sobre', imagem = 'sem-foto.jpg', exibir = 'Imagem'");
    } else {
        $titulo_sobre = $res[0]['titulo'];
        $subtitulo_sobre = $res[0]['subtitulo'];
        $descricao_sobre = $res[0]['descricao'];
        $imagem_sobre = $res[0]['imagem'];
        $exibir_sobre = $res[0]['exibir'];
    }
} catch (Exception $e) {
    echo 'Erro ao acessar a tabela sobre: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Serviços</title>
</head>
<body>
    <h1>Lista de Serviços</h1>
    <ul>
        <?php
        $query = $pdo->query("SELECT * FROM servicos");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $servico) {
            echo "<li>" . $servico['nome'] . " - R$ " . $servico['preco'] . "</li>";
        }
        ?>
    </ul>
</body>
</html>
