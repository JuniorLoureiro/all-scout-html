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
    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email'];
    $usuario->cpf = $_POST['cpf'];
    $usuario->senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha
    $usuario->cep = $_POST['cep'];
    $usuario->cidade = $_POST['cidade'];
    $usuario->logradouro = $_POST['logradouro'];
    $usuario->complemento = $_POST['complemento'];
    $usuario->username = $_POST['username'];
    $usuario->celular = $_POST['celular'];
    $usuario->data_nascimento = $_POST['data-nascimento'];
    $usuario->estado = $_POST['estado'];
    $usuario->bairro = $_POST['bairro'];
    $usuario->numEnd = $_POST['numEnd'];

    // Tenta registrar o usuário
    if ($usuario->registrar()) {
        // Redireciona para a página de login
        header("Location: ../html/login.php");
        exit();
    } else {
        echo "Erro ao registrar o usuário.";
    }
}
?>
