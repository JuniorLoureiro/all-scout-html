<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatísticas Atletas</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Inclua o seu arquivo CSS -->
</head>
<body>

    <!-- Barra de Navegação -->
    <header class="top-nav">
        <div class="top-nav-container">
            <!-- Parte esquerda -->
            <div class="left-nav">
                <a href="home.html"><img src="../images/mini_logo.png" alt="Mini Logo" class="mini-logo"></a>
                <nav class="main-nav">
                    <a href="home.html">Início</a>
                    <a href="clubes.html">Clubes</a>
                    <a href="atletas.html">Atletas</a>
                    <a href="sobrenos.html">Sobre Nós</a>
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
                <a href="login.html" class="account-button">Minha Conta</a>
            </div>
        </div>
    </header>

    <div class="font-controls">
        <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
        <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
    </div>

    <!-- Conteúdo Principal -->
    <main class="content-wrapper-atleta">

        <div class="player-name-image">
        <div class="left"> <h1>Neymar Jr</h1> </div>  
        <div class="right"> <img src="../images/Design sem nome.jpg"> </div>  
        
        
    </div>

        <!-- Informações do Jogador -->
        <section class="player-info">
            <h2>Informações do Jogador</h2>
            <p><label>Nome:</label> </p>
            <p><label>Nacionalidade:</label></p>
            <p><label>Data de Nascimento:</label></p>
            <p><label>Altura:</label></p>
            <p><label>Perna Dominante:</label></p>
            <p><label>Posição:</label> </p>
            <p><label>Clube Atual:</label> </p>
            <p><label>Número:</label> </p>
        </section>
    

        <!-- Estatísticas do Jogador -->
        <section class="player-stats">
            <h2>Estatísticas:</h2>
            <div><p><label>Em andamento...</label></p></div>
            
            
        </section>
    </main>
    <!-- Rodapé -->
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