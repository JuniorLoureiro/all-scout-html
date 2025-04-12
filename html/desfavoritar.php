<?php
session_start();
require_once('../php/Database.php');
$conn = new Database();
$db = $conn->getConnection();

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(["erro" => "Usuário não está logado"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_atleta'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_atleta = $_POST['id_atleta'];

    try {
        $stmt = $db->prepare("DELETE FROM favoritos WHERE id_usuario = :id_usuario AND id_atleta = :id_atleta");
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':id_atleta' => $id_atleta
        ]);

        echo json_encode(["sucesso" => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["erro" => "Erro ao desfavoritar: " . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["erro" => "Dados inválidos"]);
}
?>
