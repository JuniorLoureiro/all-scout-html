<?php
session_start();

// Destrói todas as informações da sessão
$_SESSION = [];
session_destroy();

// Redireciona para a página de login
header("Location: ../html/login.php"); // ajuste o caminho se necessário
exit();
?>