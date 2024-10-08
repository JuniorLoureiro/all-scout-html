<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações time</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Inclua o seu arquivo CSS -->
</head>
<body>

    <!-- Barra de Navegação -->
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
   

<main class="exibe-time">
    <!-- Conteúdo Principal -->

    <section class="club-info">
        <div class="club-header">
            <h5 class="tituloClube">FC Bayern München</h5>
            <img src="../images/TIMES/madrid.jpg" alt="Escudo do Clube" class="club-logo">
            <img src="../images/TIMES/bernabeu.jpg" alt="Foto do Estádio" class="stadium-photo">
            
        </div>
        <hr class="horizontal-line">
     <table>
        <tr>
            <td>
    <div class="content-wrapper-club">     
            <div class="club-details">
                <div class="left-info">
                    <h2>Informações Gerais</h2>
                    <p><label>Nome do Clube:</label> FC Bayern München</p>
                    <p><label>Fundação:</label> 1900</p>
                    <p><label>Estádio:</label> Allianz Arena</p>
                    <p><label>Capacidade:</label> 75.024</p>
                    <p><label>Presidente:</label> Jan-Christian Dreesen</p>
                    <p><label>Treinador:</label> Vincent Kompany</p>
                    <p><label>Localização:</label> Munique, Alemanha</p>
                    <p><label>Capitão:</label> Manuel Neuer</p>
                    <p><label>Tamanho do elenco</label> 35 jogadores</p>
                </div>
                <div class="divider"></div>
                <div class="middle-info">
                    <h2>Títulos Conquistados</h2>
                    <p><label>Títulos Internacionais:</label> 14</p>
                    <p><label>Títulos Nacionais:</label> 69</p>
                    <p><label>Títulos continentais:</label> 10</p>
                    <p><label>Títulos Municipais:</label> 12</p>
                    <p><label>Títulos Mundiais:</label> 4</p>
                </div>
                <div class="divider"></div>
                <div class="right-info">
                    <h2>Estatísticas da Temporada</h2>
                    <p><label>Jogos Disputados:</label> 2</p>
                    <p><label>Vitórias:</label> 2</p>
                    <p><label>Empates:</label> 0</p>
                    <p><label>Derrotas:</label> 0</p>
                    <p><label>Gols Marcados:</label> 8</p>
                    <p><label>Gols Sofridos:</label> 0</p>
                    <p><label>Pontos na liga:</label> 3</p>
                </div>
            </div>
            </div>
            </td>
            <td>

                <h2>Elenco Atual</h2>
                <div class="scrollable-buttons">
                    <button class="custom-button button1" onclick="window.location.href='exibeAtleta.html';">
                        <img src="../images/ELENCO/kane.jpeg" alt="" class="button-icon"> Harry Kane
                    </button>
                    <button class="custom-button button2">
                        <img src="../images/ELENCO/mul.jpg" alt="" class="button-icon"> Jamal Musiala
                    </button>
                    <button class="custom-button button3">
                        <img src="../images/ELENCO/neuer.jpg" alt="" class="button-icon"> Manuel Neuer
                    </button>
                    <button class="custom-button button1">
                        <img src="../images/ELENCO/muller.jpg" alt="" class="button-icon"> Thomas Müller
                    </button>
                    <button class="custom-button button2">
                        <img src="../images/ELENCO/coman.png" alt="" class="button-icon"> Kingsley Coman
                    </button>
                    <button class="custom-button button3">
                        <img src="../images/ELENCO/kimich.png" alt="" class="button-icon"> Joshua Kimmich
                    </button>
                </div>
                
            </td>
        </tr>
        </table>

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