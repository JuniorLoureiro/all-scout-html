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

if (!$db) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

// Obtém os dados do usuário
$data = json_decode(file_get_contents('php://input'), true);

$nome = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$cpf = trim($data['cpf'] ?? '');
$senha = $data['senha'] ?? '';
$cep = trim($data['cep'] ?? '');
$cidade = trim($data['cidade'] ?? '');
$logradouro = trim($data['logradouro'] ?? '');
$complemento = trim($data['complemento'] ?? '');
$username = trim($data['username'] ?? '');
$celular = trim($data['celular'] ?? '');
$dataNascimento = trim($data['data_nascimento'] ?? '');
$estado = trim($data['estado'] ?? '');
$bairro = trim($data['bairro'] ?? '');
$numEnd = trim($data['numEnd'] ?? '');
$tipoUsuario = trim($data['tipo_usuario'] ?? 'usuario');

// Valida os dados obrigatórios
if (!$nome || !$email || !$cpf || !$senha || !$username) {
    echo json_encode(['success' => false, 'message' => 'Nome, email, CPF, senha e username são obrigatórios.']);
    exit;
}

// Verifica se CPF ou email já existem no banco
try {
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE cpf = :cpf OR email = :email OR username = :username");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'CPF, email ou username já cadastrados.']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao verificar usuário existente: ' . $e->getMessage()]);
    exit;
}

// Hash da senha para armazenamento seguro
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere o usuário no banco de dados
try {
    $stmt = $db->prepare("INSERT INTO usuarios (nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd, tipo_usuario) 
                          VALUES (:nome, :email, :cpf, :senha, :cep, :cidade, :logradouro, :complemento, :username, :celular, :data_nascimento, :estado, :bairro, :numEnd, :tipo_usuario)");
    
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

    echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar usuário: ' . $e->getMessage()]);
}
?>
