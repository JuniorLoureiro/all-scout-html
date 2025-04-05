<?php
include 'Database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id_atleta'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

$id = $data['id_atleta'];
$posicao = $data['posicao'];

// Verifica se todos os campos obrigatórios estão preenchidos (dependendo da posição)
$camposObrigatoriosLinha = ['finalizacao', 'drible', 'aceleracao', 'conducao', 'passe', 'desarme', 'interceptacao', 'jogo_aereo'];
$camposObrigatoriosGK = ['reflexo_gk', 'rebote_gk', 'posicionamento_gk', 'saida_gol_gk', 'impulsao_gk', 'penaltis_gk'];

$camposFaltando = [];

if (strtolower($posicao) === 'goleiro') {
    foreach ($camposObrigatoriosGK as $campo) {
        if (!isset($data[$campo]) || $data[$campo] === "") {
            $camposFaltando[] = $campo;
        }
    }
} else {
    foreach ($camposObrigatoriosLinha as $campo) {
        if (!isset($data[$campo]) || $data[$campo] === "") {
            $camposFaltando[] = $campo;
        }
    }
}

if (count($camposFaltando) > 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha todos os campos obrigatórios: ' . implode(', ', $camposFaltando)]);
    exit;
}

try {
    $db = new Database();
    $pdo = $db->getConnection();

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM caracteristicas WHERE id_atleta = ?");
    $stmt->execute([$id]);
    $existe = $stmt->fetchColumn() > 0;

    if ($existe) {
        $sql = "UPDATE caracteristicas SET posicao = :posicao,
            finalizacao = :finalizacao, drible = :drible, aceleracao = :aceleracao, conducao = :conducao,
            passe = :passe, desarme = :desarme, interceptacao = :interceptacao, jogo_aereo = :jogo_aereo,
            reflexo_gk = :reflexo_gk, rebote_gk = :rebote_gk, posicionamento_gk = :posicionamento_gk,
            saida_gol_gk = :saida_gol_gk, impulsao_gk = :impulsao_gk, penaltis_gk = :penaltis_gk
            WHERE id_atleta = :id";
    } else {
        $sql = "INSERT INTO caracteristicas (id_atleta, posicao, finalizacao, drible, aceleracao, conducao,
            passe, desarme, interceptacao, jogo_aereo, reflexo_gk, rebote_gk, posicionamento_gk,
            saida_gol_gk, impulsao_gk, penaltis_gk)
            VALUES (:id, :posicao, :finalizacao, :drible, :aceleracao, :conducao, :passe, :desarme, 
            :interceptacao, :jogo_aereo, :reflexo_gk, :rebote_gk, :posicionamento_gk, :saida_gol_gk, 
            :impulsao_gk, :penaltis_gk)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':posicao' => $posicao,
        ':finalizacao' => $data['finalizacao'] ?? null,
        ':drible' => $data['drible'] ?? null,
        ':aceleracao' => $data['aceleracao'] ?? null,
        ':conducao' => $data['conducao'] ?? null,
        ':passe' => $data['passe'] ?? null,
        ':desarme' => $data['desarme'] ?? null,
        ':interceptacao' => $data['interceptacao'] ?? null,
        ':jogo_aereo' => $data['jogo_aereo'] ?? null,
        ':reflexo_gk' => $data['reflexo_gk'] ?? null,
        ':rebote_gk' => $data['rebote_gk'] ?? null,
        ':posicionamento_gk' => $data['posicionamento_gk'] ?? null,
        ':saida_gol_gk' => $data['saida_gol_gk'] ?? null,
        ':impulsao_gk' => $data['impulsao_gk'] ?? null,
        ':penaltis_gk' => $data['penaltis_gk'] ?? null,
    ]);

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Características salvas com sucesso!']);
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao salvar: ' . $e->getMessage()]);
}
