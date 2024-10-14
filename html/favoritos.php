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
            <div class="left-nav">
                <a href="home.php"><img src="../images/mini_logo.png" alt="Mini Logo" class="mini-logo"></a>
                <nav class="main-nav">
                    <a href="home.php">Início</a>
                    <a href="clubes.php">Clubes</a>
                    <a href="atletas.php">Atletas</a>
                    <a href="sobrenos.php">Sobre Nós</a>
                </nav>
            </div>
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Pesquise...">
            </div>
            <div class="right-nav">
                <?php
                 // Verifica se a sessão já está iniciada
                 if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    echo '<a href="perfilUser.php" class="account-button">' . htmlspecialchars($_SESSION['username']) . '</a>';
                } else {
                    echo '<a href="login.php" class="account-button">Minha Conta</a>';
                }
                ?>
            </div>
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
        if (isset($_SESSION['favoritos']) && !empty($_SESSION['favoritos'])) {
            foreach ($_SESSION['favoritos'] as $atleta) {
                echo '<div class="favorito-item">'; // Classe nova para item
                echo '    <a href="#" class="button-atleta">'; // Usando link para manter o estilo
                echo '        <div class="button-content-atleta">'; // Mantendo estrutura para conteúdo
                echo '            <h3 class="button-title-atleta">' . htmlspecialchars($atleta['nome']) . '</h3>';
                echo '            <p class="button-info-atleta">Posição: ' . htmlspecialchars($atleta['posicao']) . '</p>';
                echo '            <p class="button-info-atleta">Clube: ' . htmlspecialchars($atleta['clube']) . '</p>';
                echo '            <p class="button-info-atleta">Número: ' . htmlspecialchars($atleta['numero']) . '</p>';
                echo '        </div>';
                echo '    </a>';
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum atleta favorito encontrado.</p>';
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
</body>
</html>
