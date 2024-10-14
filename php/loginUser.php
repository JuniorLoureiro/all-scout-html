// loginUser.php
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

                // Armazena os dados do usuário na sessão
                $_SESSION['nome'] = $usuario->nome;
                $_SESSION['email'] = $usuario->email;
                $_SESSION['tipo_usuario'] = $usuario->tipo_usuario; // Adiciona o tipo de usuário

                // Verifica se o usuário é administrador
                if ($usuario->tipo_usuario == 'admin') {
                    // Redireciona para o painel de administração
                    header("Location: ../html/admin_dashboard.php");
                } else {
                    // Redireciona para a página inicial do usuário
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
