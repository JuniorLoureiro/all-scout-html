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
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Pesquise...">
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
            <h2>Informações do Jogador</h2>
            <p><label>Nacionalidade:</label> <?php echo htmlspecialchars($jogador['nacionalidade']); ?></p>
            <?php
                // Supondo que a variável $dataNascimento armazena a data de nascimento no formato 'YYYY-MM-DD'
                $dataNascimento = $jogador['data_nascimento'];

                // Converte a data de nascimento em um objeto DateTime
                $dataNascimentoObj = new DateTime($dataNascimento);

                $dataFormatada = $dataNascimentoObj->format('d / m / Y');

                // Obtém a data atual
                $dataAtual = new DateTime();

                // Calcula a diferença entre a data de nascimento e a data atual
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
    <script src="../js/buscaAtleta.js"></script>
</body>
</html>