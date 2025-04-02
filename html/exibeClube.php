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
    // Conexão com o banco de dados
    include('../php/Database.php');
    $conn = new Database();
    $db = $conn->getConnection();

    // Obtendo o ID do clube a ser exibido
    $clube_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    // Consulta para obter os detalhes do clube
    $query_clube = "SELECT c.nome, c.nomeCompleto, c.fundacao, c.estadio, c.capacidade, c.presidente, c.treinador, c.localizacao, c.capitao, c.tam_elenco, c.imagem, c.estadio_img, l.nome AS liga_nome 
                    FROM clubes c 
                    JOIN liga l ON c.liga_id = l.id 
                    WHERE c.id = :clube_id";
    $stmt_clube = $db->prepare($query_clube);
    $stmt_clube->bindParam(':clube_id', $clube_id);
    $stmt_clube->execute();
    $clube = $stmt_clube->fetch(PDO::FETCH_ASSOC);

    // Consulta para obter os títulos do clube
    $query_titulos = "SELECT t.internacional, t.nacional, t.continental, t.regional, t.mundial 
                    FROM titulos t 
                    JOIN titulos_clubes tc ON t.id = tc.titulos_id 
                    WHERE tc.clube_id = :clube_id";
    $stmt_titulos = $db->prepare($query_titulos);
    $stmt_titulos->bindParam(':clube_id', $clube_id);
    $stmt_titulos->execute();
    $titulos = $stmt_titulos->fetch(PDO::FETCH_ASSOC);

    // Consulta para obter as estatísticas do clube
    $query_estatisticas = "SELECT e.jogos, e.vitorias, e.empates, e.derrotas, e.gols_marcados, e.gols_sofridos, e.aproveitamento
                    FROM estatisticas e 
                    JOIN estatisticas_clubes ec ON e.id = ec.estatisticas_id 
                    WHERE ec.clube_id = :clube_id";
    $stmt_estatisticas = $db->prepare($query_estatisticas);
    $stmt_estatisticas->bindParam(':clube_id', $clube_id);
    $stmt_estatisticas->execute();
    $estatisticas = $stmt_estatisticas->fetch(PDO::FETCH_ASSOC);

    // Consulta para obter o elenco atual do clube
    $query_atletas = "SELECT a.id, a.nome, a.imagem, p.nome AS posicao, c.nome AS clube
                    FROM atletas a
                    JOIN clube_atleta ca ON a.id = ca.atleta_id
                    JOIN clubes c ON ca.clube_id = c.id
                    JOIN posicoes p ON a.posicao_id = p.id
                    WHERE ca.clube_id = :clube_id";

    $stmt_atletas = $db->prepare($query_atletas);
    $stmt_atletas->bindParam(':clube_id', $clube_id, PDO::PARAM_INT);
    $stmt_atletas->execute();
    $atletas = $stmt_atletas->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <main class="exibe-time">
        <section class="club-info">
            <div class="club-header">
                <h5 class="tituloClube"><?= htmlspecialchars($clube['nome']) ?></h5>
                <img src="<?= htmlspecialchars($clube['imagem']) ?>" alt="Escudo do Clube" class="club-logo">
                <img src="<?= htmlspecialchars($clube['estadio_img']) ?>" alt="Foto do Estádio" class="stadium-photo">
            </div>
            <hr class="horizontal-line">
            <table>
                <tr>
                    <td>
                        <div class="content-wrapper-club">     
                            <div class="club-details">
                                <div class="left-info">
                                    <h2>Informações Gerais</h2>
                                    <p><label>Nome do Clube:</label> <?= htmlspecialchars($clube['nomeCompleto']) ?></p>
                                    <p><label>Fundação:</label> <?= htmlspecialchars($clube['fundacao']) ?></p>
                                    <p><label>Estádio:</label> <?= htmlspecialchars($clube['estadio']) ?></p>
                                    <p><label>Capacidade:</label> <?= htmlspecialchars($clube['capacidade']) ?> pessoas</p>
                                    <p><label>Presidente:</label> <?= htmlspecialchars($clube['presidente']) ?></p>
                                    <p><label>Treinador:</label> <?= htmlspecialchars($clube['treinador']) ?></p>
                                    <p><label>Localização:</label> <?= htmlspecialchars($clube['localizacao']) ?></p>
                                    <p><label>Capitão:</label> <?= htmlspecialchars($clube['capitao']) ?></p>
                                    <p><label>Tamanho do elenco:</label> <?= htmlspecialchars($clube['tam_elenco']) ?> jogadores</p>
                                    <p><label>Liga Nacional:</label> <?= htmlspecialchars($clube['liga_nome']) ?></p>
                                </div>
                                <div class="divider"></div>
                                <div class="middle-info">
                                    <h2>Títulos Conquistados</h2>
                                    <p><label>Títulos Internacionais:</label> <?= htmlspecialchars($titulos['internacional']) ?></p>
                                    <p><label>Títulos Mundiais:</label> <?= htmlspecialchars($titulos['mundial']) ?></p>
                                    <p><label>Títulos Continentais:</label> <?= htmlspecialchars($titulos['continental']) ?></p>
                                    <p><label>Títulos Nacionais:</label> <?= htmlspecialchars($titulos['nacional']) ?></p>
                                    <p><label>Títulos Regionais:</label> <?= htmlspecialchars($titulos['regional']) ?></p>
                                    
                                </div>
                                <div class="divider"></div>
                                <div class="right-info">
                                    <h2>Estatísticas da Temporada</h2>
                                    <p><label>Jogos Disputados:</label> <?= htmlspecialchars($estatisticas['jogos']) ?></p>
                                    <p><label>Vitórias:</label> <?= htmlspecialchars($estatisticas['vitorias']) ?></p>
                                    <p><label>Empates:</label> <?= htmlspecialchars($estatisticas['empates']) ?></p>
                                    <p><label>Derrotas:</label> <?= htmlspecialchars($estatisticas['derrotas']) ?></p>
                                    <p><label>Gols Marcados:</label> <?= htmlspecialchars($estatisticas['gols_marcados']) ?></p>
                                    <p><label>Gols Sofridos:</label> <?= htmlspecialchars($estatisticas['gols_sofridos']) ?></p>
                                    <p><label>Aproveitamento (%):</label> <?= htmlspecialchars($estatisticas['aproveitamento']) ?></p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h2>Elenco Atual</h2>
                        <div class="scrollable-buttons">
                            <?php foreach ($atletas as $atleta): ?>
                                <button class="custom-button" onclick="window.location.href='exibeAtleta.php?id=<?= htmlspecialchars($atleta['id']) ?>';">
                                    <img src="<?= htmlspecialchars($atleta['imagem']) ?>" alt="<?= htmlspecialchars($atleta['nome']) ?>" class="button-icon"> 
                                    <?= htmlspecialchars($atleta['nome']) ?>
                                    <?= "(",htmlspecialchars($atleta['posicao']) ,")"?>
                                </button>
                            <?php endforeach; ?>
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