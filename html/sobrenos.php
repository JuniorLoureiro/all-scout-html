<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre os Criadores</title>
    <link rel="stylesheet" href="../css/styles.css">
       
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

    <nav>
        <section id="about-intro">
            <center><h1>Bem-vindo ao Projeto All-Scout</h1></center>
            <p></p>
        </section>

        <section id="about-description">
            <p>
                O All-Scout é um projeto dedicado à análise abrangente e detalhada do futebol, focado em explorar e destacar o talento de jogadores de todas as divisões e categorias. A plataforma oferece uma visão global das habilidades e desempenhos dos jogadores, desde as categorias de base até as principais ligas profissionais. Com uma abordagem imparcial e criteriosa, o All-Scout busca ser uma referência para técnicos, olheiros e entusiastas do futebol, ajudando na descoberta e valorização de novos talentos.
            </p>

            <p>
                O All-Scout foi criado para oferecer uma solução que facilita o acesso aos dados esportivos para o público geral. Empresários, dirigentes e até mesmo amantes do futebol podem se beneficiar de uma plataforma que centraliza e automatiza a coleta e a análise de dados de forma simples e intuitiva.
            </p>
        </section>

        <section id="about-team">
            <div class="about-card">
                <img src="../images/logo.png" alt="Foto do Criador 1">
                <h3>Davi Santos, Gelson Junior, Lucas Laner, Mateus Assumpção e Lucas Roppa</h3>
                <p>Todos os 5 eram colegas na Instituição de ensino Senac Tech do Curso de Técnico de Desenvolvimento de Sistemas, e tiveram a ideia do All-Scout como projeto Integrador.
                    <br>O projeto de início era pra ser um jogo que se chamaria "Clube do Bolinha", mas tivemos que mudar por causa das dificuldades de fazer um jogo.
                </p>
            </div>
        </section>

        <section id="about-location">
            <div class="about-card">
                <img src="../images/senactech.jpg" alt="Foto empresa">
                <br>
                <p>
                    Local onde a empresa se encontra:
                    <br>Av. Venâncio Aires, 93 - Cidade Baixa, Porto Alegre - RS, 90040-191
                </p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.79161441889!2d-51.2188929!3d-30.0428357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951978567f17f28d%3A0x2c2c5272bacf4d3a!2sSenac%20Tech!5e0!3m2!1spt-BR!2sbr!4v1744327605371!5m2!1spt-BR!2sbr"
                    width="100%" height="400" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
    </nav>

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
    <script src="../js/searchGeral.js"></script>
    <script src="../js/vlibras.js"></script>
    <script src="../js/fontAccessibility.js"></script>
</body>
</html>