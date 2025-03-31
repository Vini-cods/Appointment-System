<?php
$host = "localhost";  
$user = "root";       
$pass = "";           
$dbname = "salao";    

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>