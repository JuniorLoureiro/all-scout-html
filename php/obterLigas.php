<?php
header('Content-Type: application/json');
include('Database.php');
$conn = new Database();
$db = $conn->getConnection();

try {
    $stmt = $db->query("SELECT id, nome FROM liga"); // Substitua 'nome' pelo campo correto
    $ligas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($ligas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro ao obter ligas: ' . $e->getMessage()]);
}