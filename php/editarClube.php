<?php
header('Content-Type: application/json');

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
    exit;
}

// Conexão com o banco de dados
include('Database.php');
$conn = new Database();
$db = $conn->getConnection();

// Obtém os dados do clube
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$nome = $data['nome'] ?? null;
$nomeCompleto = $data['nomeCompleto'] ?? null;
$imagem = $data['imagem'] ?? null;
$fundacao = $data['fundacao'] ?? null;
$estadio = $data['estadio'] ?? null;
$capacidade = $data['capacidade'] ?? null;
$presidente = $data['presidente'] ?? null;
$treinador = $data['treinador'] ?? null;
$localizacao = $data['localizacao'] ?? null;
$capitao = $data['capitao'] ?? null;
$tam_elenco = $data['tam_elenco'] ?? null;
$liga_id = $data['liga_id'] ?? null; // Adicionei o campo liga_id

// Verifica se o ID está presente para editar
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID do clube não fornecido.']);
    exit;
}

// Valida os dados obrigatórios
if (!$nome || !$nomeCompleto || !$fundacao || !$estadio || !$presidente || !$treinador || !$localizacao || !$capitao || !$tam_elenco || !$liga_id) {
    echo json_encode(['success' => false, 'message' => 'Todos os campos obrigatórios devem ser preenchidos.']);
    exit;
}

try {
    // Atualiza os dados do clube no banco de dados
    $stmt = $db->prepare("UPDATE clubes SET nome = :nome, nomeCompleto = :nomeCompleto, imagem = :imagem, fundacao = :fundacao, estadio = :estadio, capacidade = :capacidade, presidente = :presidente, treinador = :treinador, localizacao = :localizacao, capitao = :capitao, tam_elenco = :tam_elenco, liga_id = :liga_id WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nomeCompleto', $nomeCompleto);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':fundacao', $fundacao);
    $stmt->bindParam(':estadio', $estadio);
    $stmt->bindParam(':capacidade', $capacidade);
    $stmt->bindParam(':presidente', $presidente);
    $stmt->bindParam(':treinador', $treinador);
    $stmt->bindParam(':localizacao', $localizacao);
    $stmt->bindParam(':capitao', $capitao);
    $stmt->bindParam(':tam_elenco', $tam_elenco);
    $stmt->bindParam(':liga_id', $liga_id);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao editar clube: ' . $e->getMessage()]);
}