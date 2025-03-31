<?php 

$usuario = 'root';
$senha = '';
$banco = 'salao';
$servidor = 'localhost';

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao conectar com o Banco de Dados!';
	echo 'Salão de beleza';
	echo $e;
}

//valores para as variaveis do sistema
$nome_sistema = 'Salão';
$email_sistema = 'vinisenai177@gmail.com';
$telefone_sistema = '(11)913105016';
$endereco_sistema = '';
$senha_sistema = '123';

//verificar se existem dados na tabela config
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', 
	senha = '$senha_sistema', telefone = '$telefone_sistema', endereco = '$endereco_sistema', 
	logo = 'logo.png', icone = 'icone.png', cor = '#00c1c1', titulo_contato = 'Contate-nos', 
	subtitulo_contato = 'Preencha os Campos abaixo para entrar em contato conosco!'");
}else{
$nome_sistema = $res[0]['nome'];
$email_sistema = $res[0]['email'];

$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
}
