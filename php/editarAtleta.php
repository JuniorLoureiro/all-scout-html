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

// Obtém os dados do atleta
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? null;
$nome = $data['nome'] ?? null;
$nacionalidade = $data['nacionalidade'] ?? null;
$dataNascimento = $data['data_nascimento'] ?? null;
$altura = $data['altura'] ?? null;
$pernaDominante = $data['perna_dominante'] ?? null;
$posicao = $data['posicao'] ?? null;
$clube = $data['clube'] ?? null;
$numero = $data['numero'] ?? null;
$imagem = $data['imagem'] ?? null;

// Verifica se o ID está presente para editar
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID do atleta não fornecido.']);
    exit;
}

// Valida os dados obrigatórios
if (!$nome || !$posicao) {
    echo json_encode(['success' => false, 'message' => 'Nome e posição são obrigatórios.']);
    exit;
}

try {
    // Atualiza os dados do atleta no banco de dados
    $stmt = $db->prepare("UPDATE atletas SET nome = :nome, nacionalidade = :nacionalidade, data_nascimento = :data_nascimento, altura = :altura, perna_dominante = :perna_dominante, posicao = :posicao, clube = :clube, numero = :numero, imagem = :imagem WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nacionalidade', $nacionalidade);
    $stmt->bindParam(':data_nascimento', $dataNascimento);
    $stmt->bindParam(':altura', $altura);
    $stmt->bindParam(':perna_dominante', $pernaDominante);
    $stmt->bindParam(':posicao', $posicao);
    $stmt->bindParam(':clube', $clube);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao editar atleta: ' . $e->getMessage()]);
}