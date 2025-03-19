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

$id = $data['id'] ?? null;
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
$dataNascimento = trim($data['data_nascimento'] ?? null);
$estado = trim($data['estado'] ?? '');
$bairro = trim($data['bairro'] ?? '');
$numEnd = trim($data['numEnd'] ?? '');
$tipoUsuario = trim($data['tipo_usuario'] ?? 'usuario');

// Verifica se o ID foi fornecido
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido.']);
    exit;
}

// Valida os dados obrigatórios
if (!$nome || !$email || !$cpf || !$username) {
    echo json_encode(['success' => false, 'message' => 'Nome, email, CPF e username são obrigatórios.']);
    exit;
}

// Verifica se já existe outro usuário com o mesmo CPF, email ou username
try {
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE (cpf = :cpf OR email = :email OR username = :username) AND id != :id");
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'CPF, email ou username já cadastrados por outro usuário.']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao verificar duplicidade: ' . $e->getMessage()]);
    exit;
}

// Atualiza a senha apenas se uma nova senha for fornecida
$senhaHash = $senha ? password_hash($senha, PASSWORD_DEFAULT) : null;

try {
    // Constrói a query dinamicamente dependendo da necessidade de atualizar a senha
    $sql = "UPDATE usuarios SET 
                nome = :nome, 
                email = :email, 
                cpf = :cpf, 
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
                tipo_usuario = :tipo_usuario";

    if ($senhaHash) {
        $sql .= ", senha = :senhaHash";
    }

    $sql .= " WHERE id = :id";

    $stmt = $db->prepare($sql);
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

    echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao editar usuário: ' . $e->getMessage()]);
}
?>
