<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Favoritos</title>
</head>
<body>

<!-- Cabeçalho -->
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

<!-- Acessibilidade de Fonte -->
<div class="font-controls">
    <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
    <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
</div>

<!-- Conteúdo aqui -->
<div class="background-admin">
<h5 class="tituloAdm">Administrador</h5>
    <nav class="nav-admin">
        <!-- Botões para alterar a tela -->
        <button class="tab-button" onclick="showSection('atletas')">Atletas</button>
        <button class="tab-button" onclick="showSection('clubes')">Clubes</button>
        <button class="tab-button" onclick="showSection('usuarios')">Usuários</button>
    </nav>

    <section class="section-admin">
        <!-- Conteúdo que vai ser alterado -->
        <div class="tab-content" id="atletas">
            <h2>Atletas</h2>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>

            <p>Conteúdo relacionado aos atletas vai aqui.</p><p>Conteúdo relacionado aos atletas vai aqui.</p>
            <p>Conteúdo relacionado aos atletas vai aqui.</p>
        </div>
        <div class="tab-content" id="clubes" style="display: none;">
            <h2>Clubes</h2>
            <p>Conteúdo relacionado aos clubes vai aqui.</p>
        </div>
        <div class="tab-content" id="usuarios" style="display: none;">
            <h2>Usuários</h2>
            <p>Conteúdo relacionado aos usuários vai aqui.</p>
        </div>
    </section>
</div>

<!-- Roda Pé -->
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

<!-- Scripts JS -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script>
    function showSection(sectionId) {
        // Esconde todos os conteúdos
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => content.style.display = 'none');

        // Mostra o conteúdo selecionado
        document.getElementById(sectionId).style.display = 'block';
    }
</script>

<script src="../js/vlibras.js"></script>
<script src="../js/fontAccessibility.js"></script>
<script src="../js/desfavorito.js"></script>

</body>
</html>