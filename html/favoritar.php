<?php
session_start();
file_put_contents('log_debug.txt', "SESSION:\n" . print_r($_SESSION, true));


// DEBUG: Mostra a sessão e os dados recebidos
file_put_contents('log_debug.txt', "SESSION:\n" . print_r($_SESSION, true) . "\nPOST:\n" . print_r($_POST, true));

require_once('../php/Database.php');
$conn = new Database();
$db = $conn->getConnection();

// Verifica a conexão
if (!$db) {
    file_put_contents('log_debug.txt', "Erro de conexão com o banco\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(["erro" => "Erro de conexão com o banco"]);
    exit;
}

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    file_put_contents('log_debug.txt', "Usuário não logado\n", FILE_APPEND);
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não está logado"]);
    exit;
}

// Verifica se o ID do atleta veio pelo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_atleta'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_atleta = $_POST['id_atleta'];

    // DEBUG: Inserção no banco
    file_put_contents('log_debug.txt', "Tentando inserir: usuario $id_usuario - atleta $id_atleta\n", FILE_APPEND);

    try {
        $stmt = $db->prepare("INSERT INTO favoritos (id_usuario, id_atleta) VALUES (:id_usuario, :id_atleta)");
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_atleta' => $id_atleta
        ]);

        file_put_contents('log_debug.txt', "SUCESSO na inserção\n", FILE_APPEND);
        echo json_encode(["sucesso" => true]);

    } catch (PDOException $e) {
        file_put_contents('log_debug.txt', "ERRO SQL: " . $e->getMessage() . "\n", FILE_APPEND);
        http_response_code(500);
        echo json_encode(["erro" => "Erro ao inserir favorito: " . $e->getMessage()]);
    }

} else {
    file_put_contents('log_debug.txt', "Dados inválidos ou método incorreto\n", FILE_APPEND);
    http_response_code(400);
    echo json_encode(["erro" => "Dados inválidos"]);
}
?>