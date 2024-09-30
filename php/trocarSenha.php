<?php
session_start();
require_once 'Database.php'; // Inclua sua classe de conexão com o banco de dados
require_once 'Usuario.php'; // Inclua sua classe de manipulação de usuários

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria uma nova conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();
    
    // Cria uma nova instância da classe Usuario
    $usuario = new Usuario($db);

    // Atribuir os valores do formulário às propriedades do objeto
    $usuario->username = $_POST['username'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];

    // Verificar se a senha atual está correta
    if ($usuario->verificarSenha($senha_atual)) {
        // Criptografa a nova senha
        $usuario->senha = password_hash($nova_senha, PASSWORD_BCRYPT);
        
        // Atualizar a senha
        if ($usuario->atualizarSenha()) {
            $_SESSION['mensagem'] = "Senha alterada com sucesso!";
            header("Location: ../html/login.php"); // Redireciona para uma página de sucesso
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro ao alterar senha.";
            header("Location: ../html/trocarSenhaHTML.php");
            exit();
        }
    } else {
            $_SESSION['mensagem'] = "Usuário ou senha atual incorreta.";
            header("Location: ../html/trocarSenhaHTML.php");
            exit();
    }
}
?>
