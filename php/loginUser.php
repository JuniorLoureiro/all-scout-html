<?php
require '../php/Database.php';
require '../php/usuario.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criação de um objeto Usuario
    $usuario = new Usuario($db);

    // Atribuindo os valores do formulário
    $usuario->username = $_POST['username'];
    $senhaInput = $_POST['password'];

    // Verifica se o usuário existe no banco
    if ($usuario->buscarPorUsername($usuario->username)) {
        // Obtém a senha do banco de dados
        if ($usuario->obterDadosPorUsername($usuario->username)) {
            // Verifica se a senha está correta
            if (password_verify($senhaInput, $usuario->senha)) {
                // Login bem-sucedido, cria a sessão
                $_SESSION['username'] = $usuario->username;
                $_SESSION['loggedin'] = true;

                // Redireciona para a página inicial ou painel do usuário
                header("Location: ../html/clubes.html");
                exit();
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Erro ao obter dados do usuário.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
