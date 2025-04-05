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
                <?php
                session_start();
                // Exibe o botão "Tela Admin" se o usuário for administrador
                if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin') {
                    echo '<a href="admin.php" class="favorites"><img src="../images/admin-icon.png" alt="Tela Admin"></a>';
                }
                ?>
                <a href="favoritos.php" class="favorites">
                    <img src="../images/heart_icon.png" alt="Favoritos">
                </a>
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

    <?php
    // Verificar se o ID foi passado pela URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // Conexão com o banco de dados
        include('../php/Database.php');
        $conn = new Database();
        $db = $conn->getConnection();

        // Consulta para obter os dados do jogador
        $query = "SELECT * FROM atletas WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar se o jogador foi encontrado
        $jogador = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$jogador) {
            echo "Jogador não encontrado.";
            exit;
        }
    } else {
        echo "ID do jogador não informado.";
        exit;
    }
    ?>

    <!-- Conteúdo Principal -->
    <main class="content-wrapper-atleta">
        <div class="player-name-image">
            <div class="left"> 
                <h1 class="left-title-atleta"><?php echo htmlspecialchars($jogador['nome']); ?></h1> 
            </div>     
            <div class="right">
                <img src="<?= htmlspecialchars($jogador['imagem']) ?>" alt="Imagem do Atleta">
            </div>
        </div>

        <!-- Informações do Jogador -->
        <section class="player-info">
            <h2> </h2>
            <section class="favoritar-atleta">
            <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    // Verifica se o atleta já está nos favoritos
                    $jaFavoritado = false;
                    if (isset($_SESSION['favoritos'])) {
                        foreach ($_SESSION['favoritos'] as $atleta) {
                            if ($atleta['id'] == $jogador['id']) {
                                $jaFavoritado = true;
                                break;
                            }
                        }
                    }

                    // Exibe o botão apropriado (favoritar ou desfavoritar)
                   if ($jaFavoritado) {
                        // Botão para desfavoritar
                        echo '
                        <button class="desfavoritar-button" data-id="' . htmlspecialchars($jogador['id']) . '" onclick="desfavoritar(' . htmlspecialchars($jogador['id']) . ')">
                            <img src="../images/excluir.png" alt="Desfavoritar" class="desfavorito">
                        </button>';
                        } else {
                            // Botão para favoritar
                            echo '
                            <button class="button-favorito" data-id="' . htmlspecialchars($jogador['id']) . '" onclick="favoritar(' . htmlspecialchars($jogador['id']) . ', \'' . htmlspecialchars($jogador['nome']) . '\', \'' . htmlspecialchars($jogador['posicao']) . '\', \'' . htmlspecialchars($jogador['clube']) . '\', ' . htmlspecialchars($jogador['numero']) . ')">
                                <img src="../images/heart_icon.png" alt="Favoritar" class="icon-favorito">
                            </button>';
                        }
                     } else {
                    // Redirecionar para a página de login se o usuário não estiver logado
                    echo '
                    <a href="login.php" class="button-favorito">
                        <img src="../images/heart_icon.png" alt="Login para favoritar" class="icon-favorito">
                    </a>';
                }
            ?>
    </section>
    <div style=" grid-column: span 2; width:95%;"> <hr class="horizontal-line"></div>
            <h2>informações do Atleta</h2>
            <p><label>Nacionalidade:</label> <?php echo htmlspecialchars($jogador['nacionalidade']); ?></p>
            <?php
                $dataNascimento = $jogador['data_nascimento'];
                $dataNascimentoObj = new DateTime($dataNascimento);
                $dataFormatada = $dataNascimentoObj->format('d / m / Y');
                $dataAtual = new DateTime();
                $idade = $dataNascimentoObj->diff($dataAtual)->y;
            ?>
            <p><label>Idade:</label> <?php echo $idade," ANOS"; ?></p>
            <p><label>Data de Nascimento:</label> <?php echo $dataFormatada; ?></p>
            <p><label>Altura:</label> <?php echo htmlspecialchars($jogador['altura']); ?></p>
            <p><label>Perna Dominante:</label> <?php echo htmlspecialchars($jogador['perna_dominante']); ?></p>
            <p><label>Posição:</label> <?php echo htmlspecialchars($jogador['posicao']); ?></p>
            <p><label>Clube:</label> <?php echo htmlspecialchars($jogador['clube']); ?></p>
            <p><label>Número:</label> <?php echo htmlspecialchars($jogador['numero']); ?></p>
        </section>

        <div style=" grid-column: span 2; "> <hr class="horizontal-line"></div>
    
        <!-- Características -->
        <section class="player-stats">
    <h2>Características:</h2>
    <?php
    $query_carac = "SELECT * FROM caracteristicas WHERE id_atleta = :id_atleta";
    $stmt_carac = $db->prepare($query_carac);
    $stmt_carac->bindParam(':id_atleta', $id, PDO::PARAM_INT);
    $stmt_carac->execute();
    $carac = $stmt_carac->fetch(PDO::FETCH_ASSOC);

    if ($carac) {
        echo "<ul>";
        echo "<li><strong>Posição:</strong> " . htmlspecialchars($carac['posicao']) . "</li>";
        echo "<li><strong>Aceleração:</strong> " . htmlspecialchars($carac['aceleracao']) . "</li>";
        echo "<li><strong>Finalização:</strong> " . htmlspecialchars($carac['finalizacao']) . "</li>";
        echo "<li><strong>Passe:</strong> " . htmlspecialchars($carac['passe']) . "</li>";
        echo "<li><strong>Drible:</strong> " . htmlspecialchars($carac['drible']) . "</li>";
        echo "<li><strong>Desarme:</strong> " . htmlspecialchars($carac['desarme']) . "</li>";
        echo "<li><strong>Interceptação:</strong> " . htmlspecialchars($carac['interceptacao']) . "</li>";
        echo "<li><strong>Jogo Aéreo:</strong> " . htmlspecialchars($carac['jogo_aereo']) . "</li>";
        echo "</ul>";
        echo "<p><strong>Overall:</strong> " . htmlspecialchars($carac['overall']) . "</p>";
    } else {
        echo "<p>Características não cadastradas para este atleta.</p>";
    }
    ?>
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
    <script src="../js/buscaAtleta.js"></script>
    <script src="../js/favorito.js"></script>

</body>
</html>
