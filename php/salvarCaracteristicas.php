<?php
include 'Database.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

try {
    $db = new Database();
$pdo = $db->getConnection();

    $stmt = $pdo->prepare("INSERT INTO caracteristicas 
        (id_atleta, posicao, finalizacao, drible, aceleracao, conducao, passe, desarme, interceptacao, jogo_aereo)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $data['id_atleta'],
        $data['posicao'],
        $data['finalizacao'],
        $data['drible'],
        $data['aceleracao'],
        $data['conducao'],
        $data['passe'],
        $data['desarme'],
        $data['interceptacao'],
        $data['jogo_aereo']
    ]);

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Características salvas com sucesso']);
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro: ' . $e->getMessage()]);
}
