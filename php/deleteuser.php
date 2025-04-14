<?php
require '../php/Database.php';
require '../php/usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo username foi enviado
    if (!isset($_POST['username']) || empty($_POST['username'])) {
        echo "Erro: Nome de usuário não fornecido.";
        exit();
    }

    // Conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criação de um objeto Usuario
    $usuario = new Usuario($db);

    // Atribui o username recebido via POST
    $username = $_POST['username'];

    // Verifica se o usuário existe antes de tentar deletar
    if ($usuario->buscarPorUsername($username)) {
        // Tenta deletar o usuário
        if ($usuario->deletar($username)) {
            header("Location: logout.php");
            exit();
        } else {
            echo "Erro ao deletar o usuário.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
