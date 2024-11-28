<?php
// Início do arquivo PHP
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexão com o banco de dados
include('../php/Database.php');
$conn = new Database();
$db = $conn->getConnection();

// Verifica se o formulário de favoritos foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Exibe os dados recebidos
    var_dump($_POST);

    if (!isset($_SESSION['favoritos'])) {
        $_SESSION['favoritos'] = [];
    }
    $_SESSION['favoritos'][] = [
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'posicao' => $_POST['posicao'],
        'clube' => $_POST['clube'],
        'numero' => $_POST['numero']
    ];
    header("Location: home.php");
    exit();
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
        <div class="left-nav">
            <a href="home.php"><img src="../images/mini_logo.png" alt="Mini Logo" class="mini-logo"></a>
            <nav class="main-nav">
                <a href="home.php">Início</a>
                <a href="clubes.php">Clubes</a>
                <a href="atletas.php">Atletas</a>
                <a href="sobrenos.php">Sobre Nós</a>
            </nav>
        </div>
        <div class="searchGeral-container">
            <input type="text" id="searchGeral-input" placeholder="Digite para buscar..." onkeyup="filterAtletas()" />
            <div class="searchGeral-results" id="searchGeral-results"></div>
        </div>

        <div class="right-nav">
            <?php
            if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') {
                echo '<a href="admin.php" class="favorites"><img src="../images/admin-icon.png" alt="Tela Admin"></a>';
            }
            ?>
            <a href="favoritos.php" class="favorites"><img src="../images/heart_icon.png" alt="Favoritos"></a>
            <?php
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

        <div id="card-carousel" class="carousel-cards">
    <button class="arrow left" onclick="scrollCarouselLeft('#card-carousel')">&#10094;</button>
    <div class="container-cards">
        <?php
            $query = "
                SELECT 
                    transferencia.id AS transf_id,
                    atletas.nome AS atleta_nome,
                    atletas.imagem AS atleta_imagem,
                    clubes_atual.nome AS clube_atual,
                    clubes_novo.nome AS clube_novo,
                    transferencia.tipoTransf,
                    transferencia.valorTransf,
                    transferencia.dataTransf
                FROM transferencia
                INNER JOIN atletas ON transferencia.idAtleta = atletas.id
                INNER JOIN clubes AS clubes_atual ON transferencia.idClubeAtual = clubes_atual.id
                INNER JOIN clubes AS clubes_novo ON transferencia.idClubeNovo = clubes_novo.id
                ORDER BY transferencia.dataTransf DESC
            ";
            
            $stmt = $db->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card-transf">';
                echo '<a href="exibeAtleta.php?id=' . htmlspecialchars($row['transf_id']) . '" class="button-atleta-transf">';
                echo '<img src="' . htmlspecialchars($row['atleta_imagem']) . '" alt="Imagem do Atleta" class="button-atleta-transf img">';
                echo '</a>';
                echo '<div class="card-content">';
                echo '<h3>' . htmlspecialchars($row['atleta_nome']) . '</h3>';
                echo '<p>Tipo: ' . htmlspecialchars($row['tipoTransf']) . '</p>';
                echo '<p>De: ' . htmlspecialchars($row['clube_atual']) . '</p>';
                echo '<p>Para: ' . htmlspecialchars($row['clube_novo']) . '</p>';
                echo '<p>Valor: R$ ' . number_format($row['valorTransf'], 2, ',', '.') . '</p>';
                echo '<p>Data: ' . date('d/m/Y', strtotime($row['dataTransf'])) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
    <button class="arrow right" onclick="scrollCarouselRight('#card-carousel')">&#10095;</button>
</div>


        
    
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
    <script src="../js/buscaAtleta.js"></script>
    <script src="../js/carouselCards.js"></script>
    <script src="../js/buscaAtleta.js"></script>
</body>
</html>
