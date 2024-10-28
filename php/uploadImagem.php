<?php
header('Content-Type: application/json');

// Verifica se um arquivo foi enviado
if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] != UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Nenhum arquivo enviado ou erro no upload.']);
    exit;
}

// Define o diretório de destino para o upload
$uploadDir = '../images/';
$uploadFile = $uploadDir . basename($_FILES['imagem']['name']);

// Verifica se o diretório existe, caso contrário, cria
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Move o arquivo para o diretório de destino
if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
    // Retorna o caminho relativo do arquivo salvo
    echo json_encode(['success' => true, 'filePath' => $uploadFile]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao mover o arquivo para o diretório de destino.']);
}