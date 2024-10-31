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

// Obtém os dados do usuário
$data = json_decode(file_get_contents('php://input'), true);
$nome = $data['nome'] ?? null;
$email = $data['email'] ?? null;
$cpf = $data['cpf'] ?? null;
$senha = $data['senha'] ?? null;
$cep = $data['cep'] ?? null;
$cidade = $data['cidade'] ?? null;
$logradouro = $data['logradouro'] ?? null;
$complemento = $data['complemento'] ?? null;
$username = $data['username'] ?? null;
$celular = $data['celular'] ?? null;
$dataNascimento = $data['data_nascimento'] ?? null;
$estado = $data['estado'] ?? null;
$bairro = $data['bairro'] ?? null;
$numEnd = $data['numEnd'] ?? null;
$tipoUsuario = $data['tipo_usuario'] ?? 'usuario';

// Valida os dados recebidos
if (!$nome || !$email || !$cpf || !$senha || !$username) {
    echo json_encode(['success' => false, 'message' => 'Nome, email, CPF, senha e username são obrigatórios.']);
    exit;
}

// Hash da senha para armazenamento seguro
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    // Insere o usuário no banco de dados
    $stmt = $db->prepare("INSERT INTO usuarios (nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd, tipo_usuario) VALUES (:nome, :email, :cpf, :senha, :cep, :cidade, :logradouro, :complemento, :username, :celular, :data_nascimento, :estado, :bairro, :numEnd, :tipo_usuario)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':logradouro', $logradouro);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':celular', $celular);
    $stmt->bindParam(':data_nascimento', $dataNascimento);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':numEnd', $numEnd);
    $stmt->bindParam(':tipo_usuario', $tipoUsuario);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar usuário: ' . $e->getMessage()]);
}