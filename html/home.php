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
    <title>Home</title>
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

    <main class="content-wrapper">
        <!-- Carrossel de Notícias -->
        <section class="news-carousel">
            <div class="carousel-slide">
                <img src="../images/news/carousel-3.jpg" alt="Notícia 1">
                <div class="carousel-content">
                    <h2><a href="noticia1.html"> </a></h2>
                    
                </div>
            </div>
           
            <div class="carousel-slide">
                <img src="../images/news/torcida.jpg" alt="Notícia 4">
                <div class="carousel-content">
                    <h2><a href="noticia4.html"> </a></h2>
                    
                </div>
            </div>
        
            <!-- Botões de navegação do carrossel -->
            <button class="carousel-prev">‹</button>
            <button class="carousel-next">›</button>
        </section>

        




        
    
        <!-- Lista de Notícias -->
        <section class="news-list">
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/times/flamengo/noticia/2025/04/15/cebolinha-do-flamengo-revela-desejo-de-retornar-ao-gremio-em-um-futuro-bem-proximo.ghtml" target="_blank"><img src="../images/news/noticia-4.avif" alt="Notícia Thumb 1" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/times/flamengo/noticia/2025/04/15/cebolinha-do-flamengo-revela-desejo-de-retornar-ao-gremio-em-um-futuro-bem-proximo.ghtml" target="_blank">Cebolinha, do Flamengo, revela desejo de retornar ao Grêmio: "Em um futuro bem próximo"</a></h2>
                    <p>Atacante deu a declaração após a vitória rubro-negra na Arena no domingo</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/al/futebol/noticia/2025/04/15/valores-atualizados-saiba-quanto-ganham-arbitros-e-assistentes-na-serie-b-do-brasileiro-em-2025.ghtml" target="_blank"><img src="../images/news/noticia-5.avif" alt="Notícia Thumb 2" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/al/futebol/noticia/2025/04/15/valores-atualizados-saiba-quanto-ganham-arbitros-e-assistentes-na-serie-b-do-brasileiro-em-2025.ghtml" target="_blank">Quanto ganham árbitros e assistentes na Série B? Veja os valores atualizados</a></h2>
                    <p>Veja quanto ganham árbitros e assistentes na Série A</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/sp/santos-e-regiao/futebol/times/santos/noticia/2025/04/15/o-saudosismo-vai-matar-o-santos-ceo-faz-duras-criticas-e-cobra-modernizacao-do-clube.ghtml"  target="_blank"><img src="../images/news/noticia-6.avif" alt="Notícia Thumb 3" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/sp/santos-e-regiao/futebol/times/santos/noticia/2025/04/15/o-saudosismo-vai-matar-o-santos-ceo-faz-duras-criticas-e-cobra-modernizacao-do-clube.ghtml"  target="_blank">"O saudosismo vai matar o Santos": CEO faz duras críticas e cobra modernização do clube</a></h2>
                    <p>Diretor explica saída de Caixinha do Santos, evita falar de Sampaoli e diz não ter pressa por técnico</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/times/corinthians/noticia/2025/04/15/escalacao-do-corinthians-dupla-volta-e-ramon-ensaia-time-com-romero-para-encarar-o-fluminense.ghtml" target="_blank"><img src="../images/news/noticia-7.avif" alt="Notícia Thumb 1" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/times/corinthians/noticia/2025/04/15/escalacao-do-corinthians-dupla-volta-e-ramon-ensaia-time-com-romero-para-encarar-o-fluminense.ghtml" target="_blank">Corinthians - Escalação: dupla volta, e Ramón ensaia time com Romero para encarar o Fluminense</a></h2>
                    <p>Técnico argentino testa mesma formação da primeira final do Paulistão, com exceção do goleiro</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/ce/futebol/libertadores/noticia/2025/04/15/vidal-enaltece-homenagem-do-fortaleza-a-torcedores-do-colo-colo-que-faleceram-seguimos-de-luto.ghtml"  target="_blank"><img src="../images/news/noticia-8.avif" alt="Notícia Thumb 2" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/ce/futebol/libertadores/noticia/2025/04/15/vidal-enaltece-homenagem-do-fortaleza-a-torcedores-do-colo-colo-que-faleceram-seguimos-de-luto.ghtml"  target="_blank">Libertadores: Vidal enaltece homenagem do Fortaleza a torcedores do Colo-Colo que faleceram: "Seguimos de luto"</a></h2>
                    <p>Volante atua no Colo-Colo. Os dois times estão no mesmo grupo da Libertadores</p>
                </div>
            </article>
        </section>
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
            <p>&copy; 2025 AllScout. Todos os direitos reservados.</p>
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
    <script src="../js/carousel.js"></script>
    <script src="../js/fontAccessibility.js"></script>
    <script src="../js/searchGeral.js"></script>
    <script src="../js/buscaAtleta.js"></script>
    <script src="../js/carouselCards.js"></script>
    <script src="../js/buscaAtleta.js"></script>
</body>
</html>
