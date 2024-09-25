<?php
require_once 'Database.php';
require_once 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criação de um objeto Usuario
    $usuario = new Usuario($db);

    // Atribuindo os valores do formulário
    $usuario->username = $_POST['username'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];

    // Verificar se o usuário e a senha atual estão corretos
    if ($usuario->verificarSenha($senha_atual)) {
        // Atualiza a senha
        $usuario->senha = password_hash($nova_senha, PASSWORD_BCRYPT); // Criptografa a nova senha
        if ($usuario->atualizarSenha()) {
            // Mensagem de sucesso
            echo "<script>alert('Senha alterada com sucesso!'); window.location.href = '../html/login.html';</script>";
            exit();
        } else {
            // Mensagem de erro ao atualizar a senha
            echo "<script>alert('Erro ao alterar a senha.'); window.history.back();</script>";
            exit();
        }
    } else {
        // Mensagem de erro se a senha atual estiver incorreta
        echo "<script>alert('Usuário ou senha atual incorretos.'); window.history.back();</script>";
        exit();
    }
}
?>