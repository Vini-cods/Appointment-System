<?php
session_start();
session_destroy();
header("Location: index.php"); // Volta para login ao sair
exit();
?>
