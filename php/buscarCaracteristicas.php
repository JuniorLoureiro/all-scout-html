<?php
include 'Database.php';
header('Content-Type: application/json');

$id = $_GET['id_atleta'] ?? null;

if (!$id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'ID inválido']);
    exit;
}

try {
    $db = new Database();
    $pdo = $db->getConnection();

    $stmt = $pdo->prepare("SELECT * FROM caracteristicas WHERE id_atleta = ?");
    $stmt->execute([$id]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        echo json_encode(['status' => 'sucesso', 'dados' => $dados]);
    } else {
        echo json_encode(['status' => 'vazio']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
}
