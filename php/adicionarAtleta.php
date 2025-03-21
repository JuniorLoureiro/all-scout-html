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
$nome = $data['nome'] ?? null;
$nacionalidade = $data['nacionalidade'] ?? null;
$dataNascimento = $data['data_nascimento'] ?? null;
$altura = $data['altura'] ?? null;
$pernaDominante = $data['perna_dominante'] ?? null;
$posicao = $data['posicao'] ?? null;
$clube = $data['clube'] ?? null;
$numero = $data['numero'] ?? null;
$imagem = $data['imagem'] ?? null;

// Valida os dados recebidos
if (!$nome || !$posicao) {
    echo json_encode(['success' => false, 'message' => 'Nome e posição são obrigatórios.']);
    exit;
}

try {
    // Insere o atleta no banco de dados
    $stmt = $db->prepare("INSERT INTO atletas (nome, nacionalidade, data_nascimento, altura, perna_dominante, posicao, clube, numero, imagem) VALUES (:nome, :nacionalidade, :data_nascimento, :altura, :perna_dominante, :posicao, :clube, :numero, :imagem)");
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
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar atleta: ' . $e->getMessage()]);
}