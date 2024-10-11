<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Atletas</title>
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

    <aside class="aside-atletas">
        <div class="atletas-container">
            <div class="atletas-row">
                <div class="col-md-12">
                    <input type="text" id="searchInput" placeholder="Pesquisar atleta..." onkeyup="filterAtletas()" />
                    <div class="atletas-buttons">
                        <?php
                        // Conexão com o banco de dados
                        include('../php/Database.php');
                        $conn = new Database();
                        $db = $conn->getConnection();

                        // Consulta para buscar atletas
                        $query = "SELECT id, nome, posicao, clube, numero FROM atletas";
                        $stmt = $db->prepare($query);
                        $stmt->execute();

                        // Exibindo os dados dos atletas como botões
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<a href="exibeAtleta.php?id=' . htmlspecialchars($row['id']) . '" class="button-atleta">';
                            echo '    <div class="button-content-atleta">';
                            echo '        <h3 class="button-title-atleta">' . htmlspecialchars($row['nome']) . '</h3>';
                            echo '        <p class="button-info-atleta">'. htmlspecialchars($row['posicao']) . 
                                ' | <span class="button-club-atleta"> ' . htmlspecialchars($row['clube']) .  
                                ' | <class="button-info-atleta"> NÚMERO: ' . htmlspecialchars($row['numero']) .'</p>';
                            echo '    </div>';
                            echo '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>

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
    <script src="../js/buscaAtleta.js"></script>
</body>
</html>