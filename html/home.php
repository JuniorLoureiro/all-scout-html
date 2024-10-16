<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Página Principal</title>
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
                <div class="searchGeral-container">
                    <input type="text" id="searchGeral-input" placeholder="Digite para buscar..." />
                    <div class="searchGeral-results" id="searchGeral-results"></div>
                </div>
                <!-- Parte direita -->
                <div class="right-nav">
                    <a href="favoritos.php" class="favorites">
                        <img src="../images/heart_icon.png" alt="Favoritos">
                    </a>
                    <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        // Usuário logado, exibe o nome de usuário
                        echo '<a href="perfilUser.php" class="account-button">' . htmlspecialchars($_SESSION['username']) . '</a>';
                    } else {
                        // Usuário não logado, exibe "Minha Conta"
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

    <main class="content-wrapper">
        <!-- Carrossel de Notícias -->
        <section class="news-carousel">
            <div class="carousel-slide">
                <img src="../images/news/carousel-1.jpg" alt="Notícia 1">
                <div class="carousel-content">
                    <h2><a href="noticia1.html">Título da Notícia 1</a></h2>
                    <p>Descrição breve da notícia 1.</p>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../images/news/carousel-2.jpg" alt="Notícia 2">
                <div class="carousel-content">
                    <h2><a href="noticia2.html">Título da Notícia 2</a></h2>
                    <p>Descrição breve da notícia 2.</p>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="../images/news/carousel-3.jpg" alt="Notícia 3">
                <div class="carousel-content">
                    <h2><a href="noticia3.html">Título da Notícia 3</a></h2>
                    <p>Descrição breve da notícia 3.</p>
                </div>
            </div>
        
            <!-- Botões de navegação do carrossel -->
            <button class="carousel-prev">‹</button>
            <button class="carousel-next">›</button>
        </section>
    
        <!-- Lista de Notícias -->
        <section class="news-list">
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/times/atletico-mg/noticia/2024/08/20/torcida-do-atletico-mg-faz-mosaico-contra-o-san-lorenzo-nao-ao-racismo.ghtml" target="_blank"><img src="../images/news/noticia-4.avif" alt="Notícia Thumb 1" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/times/atletico-mg/noticia/2024/08/20/torcida-do-atletico-mg-faz-mosaico-contra-o-san-lorenzo-nao-ao-racismo.ghtml" target="_blank">Torcida do Atlético-MG faz mosaico contra o San Lorenzo: "Não ao racismo"</a></h2>
                    <p>Partida pela Libertadores, na Arena MRV, tem mosaico em manifestação contra o racismo</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/times/fluminense/noticia/2024/08/21/artilharia-troca-de-bracadeira-e-penalti-thiago-silva-vive-noite-de-lider-em-classificacao-do-fluminense.ghtml" target="_blank"><img src="../images/news/noticia-5.avif" alt="Notícia Thumb 2" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/times/fluminense/noticia/2024/08/21/artilharia-troca-de-bracadeira-e-penalti-thiago-silva-vive-noite-de-lider-em-classificacao-do-fluminense.ghtml" target="_blank">Thiago Silva conta por que decidiu bater pênalti em vaga do Fluminense</a></h2>
                    <p>Mano vê frieza nos pênaltis e prevê "efeito positivo" em recuperação no Brasileiro</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/times/corinthians/noticia/2024/08/20/corinthians-faz-proposta-ao-west-ham-para-contratar-zagueiro-luizao.ghtml"  target="_blank"><img src="../images/news/noticia-6.avif" alt="Notícia Thumb 3" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/times/corinthians/noticia/2024/08/20/corinthians-faz-proposta-ao-west-ham-para-contratar-zagueiro-luizao.ghtml"  target="_blank">Corinthians faz proposta ao West Ham para contratar zagueiro Luizão</a></h2>
                    <p>Clube inglês aceita emprestar o jogador e negocia condições para venda em 2025</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/sp/tem-esporte/futebol/brasileirao-serie-b/jogo/20-08-2024/novorizontino-ituano.ghtml" target="_blank"><img src="../images/news/noticia-7.avif" alt="Notícia Thumb 1" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/sp/tem-esporte/futebol/brasileirao-serie-b/jogo/20-08-2024/novorizontino-ituano.ghtml" target="_blank">Novorizontino bate Ituano e dorme na liderança</a></h2>
                    <p>Lucca fez o único gol do jogo</p>
                </div>
            </article>
            <article class="news-item">
                <a href="https://ge.globo.com/futebol/selecao-brasileira/noticia/2024/08/20/eliminatorias-cbf-anuncia-brasil-x-peru-no-mane-garrincha-em-brasilia.ghtml"  target="_blank"><img src="../images/news/noticia-8.avif" alt="Notícia Thumb 2" class="news-thumb"></a>
                <div class="news-content">
                    <h2><a href="https://ge.globo.com/futebol/selecao-brasileira/noticia/2024/08/20/eliminatorias-cbf-anuncia-brasil-x-peru-no-mane-garrincha-em-brasilia.ghtml"  target="_blank">CBF anuncia Brasil x Peru no Mané Garrincha, pelas Eliminatórias</a></h2>
                    <p>Seleção jogará na capital federal sua partida como mandante da rodada de outubro do torneio</p>
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
    <script src="../js/carousel.js"></script>
    <script src="../js/fontAccessibility.js"></script>
    <script src="../js/searchGeral.js"></script>
</body>
</html>
