<?php
// Início do arquivo PHP
// Verifica se a sessão já está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o formulário foi enviado via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_atleta'])) {
    $idAtleta = $_POST['id_atleta'];

    // Verifica se o atleta está nos favoritos e o remove
    if (isset($_SESSION['favoritos'])) {
        foreach ($_SESSION['favoritos'] as $index => $atleta) {
            if ($atleta['id'] == $idAtleta) {
                unset($_SESSION['favoritos'][$index]);
                // Reorganiza o array para remover o espaço vazio
                $_SESSION['favoritos'] = array_values($_SESSION['favoritos']);
                echo json_encode(['success' => true, 'message' => 'Atleta desfavoritado com sucesso!']);
                exit();
            }
        }
    }

    echo json_encode(['success' => false, 'message' => 'Atleta não encontrado nos favoritos.']);
    exit();
}
?>
