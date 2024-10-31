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
$id = $data['id'] ?? null;
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
$tipoUsuario = $data['tipo_usuario'] ?? null;

// Verifica se o ID está presente para editar
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido.']);
    exit;
}

// Valida os dados obrigatórios
if (!$nome || !$email || !$cpf || !$username) {
    echo json_encode(['success' => false, 'message' => 'Nome, email, CPF e username são obrigatórios.']);
    exit;
}

// Atualiza a senha se fornecida
$senhaHash = $senha ? password_hash($senha, PASSWORD_DEFAULT) : null;

try {
    // Atualiza os dados do usuário no banco de dados
    $stmt = $db->prepare("UPDATE usuarios SET 
        nome = :nome, 
        email = :email, 
        cpf = :cpf, 
        " . ($senhaHash ? "senha = :senhaHash," : "") . "
        cep = :cep, 
        cidade = :cidade, 
        logradouro = :logradouro, 
        complemento = :complemento, 
        username = :username, 
        celular = :celular, 
        data_nascimento = :data_nascimento, 
        estado = :estado, 
        bairro = :bairro, 
        numEnd = :numEnd, 
        tipo_usuario = :tipo_usuario 
        WHERE id = :id");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    if ($senhaHash) {
        $stmt->bindParam(':senhaHash', $senhaHash);
    }
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
    echo json_encode(['success' => false, 'message' => 'Erro ao editar usuário: ' . $e->getMessage()]);
}