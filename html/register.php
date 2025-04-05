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
    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclua o jQuery primeiro -->
</head>
<body class="register-body">
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

    <main class="form-wrapper">
        <form action="../php/registerUser.php" method="POST" class="form-container">
            <h2 class="form-title">Cadastro</h2>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Digite seu username">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email">
            </div>

            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="tel" id="celular" name="celular" placeholder="Digite seu celular">
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF">
            </div>

            <div class="form-group">
                <label for="data-nascimento">Data de Nascimento:</label>
                <input type="date" id="data-nascimento" name="data-nascimento">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
            </div>

            <div class="form-group">
                <label for="confirmasenha">Confirmar Senha:</label>
                <input type="password" id="confirmasenha" name="confirmasenha" placeholder="Confirme sua senha">
            </div>

            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" placeholder="Digite seu CEP">
            </div>

            <div class="form-group">
                <label for="logradouro">Logradouro:</label>
                <input type="text" id="logradouro" name="logradouro" placeholder="Logradouro" readonly>
            </div>

            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" readonly>
            </div>

            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" readonly>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" placeholder="Estado" readonly>
            </div>

            <div class="form-group">
                <label for="numEnd">Número:</label>
                <input type="text" id="numEnd" name="numEnd" placeholder="Número">
            </div>

            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento" placeholder="Complemento">
            </div>

            <button type="submit" class="form-button">Registrar</button>
        </form>
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
    <script src="../js/sintaxeInput.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/buscarEndereco.js"></script>
    <script src="../js/vlibras.js"></script>
    <script src="../js/fontAccessibility.js"></script>

</body>
</html>
