<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../php/Database.php'); // Caminho correto do seu arquivo de conexão
$conn = new Database();
$db = $conn->getConnection(); // <<< ESSA linha cria a variável $db que está faltando
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Favoritos</title>

</head>
<body>
<header class="top-nav">
    <div class="top-nav-container">
        <a href="home.php"><img src="../images/mini_logo.png" alt="Mini Logo" class="mini-logo"></a>

        <nav class="main-nav">
            <a href="home.php">Início</a>
            <a href="clubes.php">Clubes</a>
            <a href="atletas.php">Atletas</a>
            <a href="sobrenos.php">Sobre Nós</a>
        </nav>

        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') : ?>
            <a href="admin.php" class="nav-icon" title="Admin">
                <img src="../images/admin-icon.png" alt="Admin">
            </a>
        <?php endif; ?>

        <a href="favoritos.php" class="nav-icon" title="Favoritos">
            <img src="../images/heart_icon.png" alt="Favoritos">
        </a>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
            <a href="perfilUser.php" class="account-button"><?= htmlspecialchars($_SESSION['username']) ?></a>
        <?php else : ?>
            <a href="login.php" class="account-button">Minha Conta</a>
        <?php endif; ?>
    </div>
</header>

    <div class="font-controls">
        <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
        <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
    </div>

    <aside class="aside-favoritos">
    <div class="favoritos-container">
    <h2>Favoritados</h2>
    <div class="atletas-buttons"> <!-- Adicionando a classe para aplicar o estilo -->
    <?php
        if (isset($_SESSION['id_usuario'])) {
                    $id_usuario = $_SESSION['id_usuario'];

                    $stmt = $db->prepare("
                        SELECT a.id, a.nome, a.posicao, a.clube, a.numero
                        FROM favoritos f
                        JOIN atletas a ON f.id_atleta = a.id
                        WHERE f.id_usuario = ?
                    ");
                    $stmt->execute([$id_usuario]);
                    $atletas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($atletas)) {
                        foreach ($atletas as $atleta) {
                            $atletaId = $atleta['id'];

                            echo '<div id="atleta-' . $atletaId . '" class="favorito-item">';
                            echo '    <a href="exibeAtleta.php?id=' . $atletaId . '" class="button-atleta">';
                            echo '        <div class="button-content-atleta">';
                            echo '            <h3 class="button-title-atleta">' . htmlspecialchars($atleta['nome']) . '</h3>';
                            echo '            <p class="button-info-atleta">Posição: ' . htmlspecialchars($atleta['posicao']) . '</p>';
                            echo '            <p class="button-info-atleta">Clube: ' . htmlspecialchars($atleta['clube']) . '</p>';
                            echo '            <p class="button-info-atleta">Número: ' . htmlspecialchars($atleta['numero']) . '</p>';
                            echo '        </div>';
                            echo '    </a>';

                            // ✅ AQUI está o ajuste: adiciona o data-id para o JS funcionar
                            echo '    <button class="desfavoritar-button1" onclick="desfavoritarDoFavoritos(' . $atletaId . ')" data-id="' . $atletaId . '">';
                            echo '        <img src="../images/excluir.png" alt="desfav" class="desfavorito1">';
                            echo '    </button>';


                            echo '</div>';
                        }
                    } else {
                        echo '<p>Nenhum atleta favoritado ainda.</p>';
                    }
                } else {
                    echo '<p>Você precisa estar logado para ver seus favoritos.</p>';
                }
        ?>


    </div>
</div>

    </aside>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4>Sobre Nós</h4>
                <p>Informações sobre a AllScout, história e missão.</p>
            </div>
            <div class="footer-section">
                <h4>Contato</h4>
                <p>Email: contato@allscout.com</p>
                <p>Telefone: (00) 1234-5678</p>
            </div>
            <div class="footer-section">
                <h4>Links Úteis</h4>
                <ul>
                    <li><a href="#">Política de Privacidade</a></li>
                    <li><a href="#">Termos de Serviço</a></li>
                    <li><a href="#">Ajuda</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Siga-nos</h4>
                <div class="social-media-icons">
                    <a href="https://www.facebook.com" target="_blank"><img src="../images/facebook_icon.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com" target="_blank"><img src="../images/instagram_icon.png" alt="Instagram"></a>
                    <a href="https://www.x.com" target="_blank"><img src="../images/twitter_icon.png" alt="Twitter"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 AllScout. Todos os direitos reservados.</p>
        </div>
    </footer>
    
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="../js/vlibras.js"></script>
    <script src="../js/fontAccessibility.js"></script>
    <script src="../js/favorito.js"></script>
    
</body>
</html>
