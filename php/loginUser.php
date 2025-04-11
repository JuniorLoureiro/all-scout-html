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
        // Obtém os dados do usuário
        if ($usuario->obterDadosPorUsername($usuario->username)) {
            // Verifica se a senha está correta
            if (password_verify($senhaInput, $usuario->senha)) {
                // Login bem-sucedido, cria a sessão
                $_SESSION['username'] = $usuario->username;
                $_SESSION['loggedin'] = true;
                $_SESSION['id_usuario'] = $usuario->id; // ✅ Aqui está correto

                // Armazena os dados do usuário na sessão
                $_SESSION['nome'] = $usuario->nome;
                $_SESSION['email'] = $usuario->email;
                $_SESSION['cpf'] = $usuario->cpf;
                $_SESSION['cep'] = $usuario->cep;
                $_SESSION['cidade'] = $usuario->cidade;
                $_SESSION['logradouro'] = $usuario->logradouro;
                $_SESSION['complemento'] = $usuario->complemento;
                $_SESSION['celular'] = $usuario->celular;
                $_SESSION['data_nascimento'] = $usuario->data_nascimento;
                $_SESSION['estado'] = $usuario->estado;
                $_SESSION['bairro'] = $usuario->bairro;
                $_SESSION['numEnd'] = $usuario->numEnd;
                $_SESSION['tipo_usuario'] = $usuario->tipo_usuario;

                // Redireciona com base no tipo de usuário
                if ($usuario->tipo_usuario === 'admin') {
                    header("Location: ../html/admin.php");
                } else {
                    header("Location: ../html/clubes.php");
                }
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
