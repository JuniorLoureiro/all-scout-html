<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Login</title>
</head>
<body>
    <header class="top-nav">
            <div class="top-nav-container">
                <!-- Parte esquerda -->
                <div class="left-nav">
                    <a href="home.php"><img src="../images/mini_logo.png" alt="Mini Logo" class="mini-logo"></a>
                    <nav class="main-nav">
                        <a href="home.php">Início</a>
                        <a href="clubes.php">Clubes</a>
                        <a href="atletas.php">Atletas</a>
                        <a href="sobrenos.php">Sobre Nós</a>
                    </nav>
                </div>
                <!-- Parte central -->
                <div class="search-container">
                    <input type="text" class="search-bar" placeholder="Pesquise...">
                </div>
                <!-- Parte direita -->
                <div class="right-nav">
                    <a href="#" class="favorites">
                        <img src="../images/heart_icon.png" alt="Favoritos">
                    </a>
                     <a href="login.php" class="account-button">Minha Conta</a>

                </div>
            </div>
        </header>

    <div class="font-controls">
        <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
        <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
    </div>

    <main class="login-wrapper">
        <div class="login-container">
            <h2>Login</h2>
            <form action="../php/loginUser.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="login-button">Entrar</button>
                </div>
                <div class="form-footer">
                    <p><a href="trocarSenhaHTML.php">Esqueceu sua senha?</a></p>
                    <p>Não tem uma conta? <a href="register.php">Registre-se</a></p>
                </div>
            </form>
        </div>
    </main>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert">
            <p><?php echo htmlspecialchars($_SESSION['mensagem']); ?></p>
        </div>
        <?php unset($_SESSION['mensagem']); // Limpa a mensagem após exibir ?>
    <?php endif; ?>

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