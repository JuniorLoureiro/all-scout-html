<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Trocar Senha</title>
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

    <main class="login-wrapper">
        <div class="login-container">
            <h2>Trocar Senha</h2>
            <!-- Exibir mensagens de erro -->
            <form action="../php/trocarSenha.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="senha_atual">Senha Atual:</label>
                    <input type="password" id="senha_atual" name="senha_atual" required>
                </div>
                <div class="form-group">
                    <label for="nova_senha">Nova Senha:</label>
                    <input type="password" id="nova_senha" name="nova_senha" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="login-button">Trocar Senha</button>
                </div>
            </form>
        </div>
    </main>

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

    <!-- Inclui o VLibras -->
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