<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
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

    <style>
        .caracteristicas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
        }

        .caracteristicas-coluna {
            flex: 1;
            min-width: 220px;
            align-items: center;
        }

        .coluna-direita {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stat-label {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-bar {
            background-color: #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
            height: 16px;
            margin-bottom: 14px;
        }

        .stat-fill {
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 2px black, 0 0 2px black;
            padding-left: 12px;
        }

        .overall-box {
            background-color: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            border-color: white;
            font-size: 42px;
            font-weight: bold;
            width: 100%;
            height: 100%;
            min-height: 180px;
            text-align: center;
        }

        .overall-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            border: 4px solid #007bff;
            border-radius: 20px;
            padding: 20px;
            min-height: 100px;
            width: 240px;
        }

        .overall-label {
            font-size: 18px;
            font-weight: 600;
            color: black;
            letter-spacing: 1px;
            margin-
        }

        .overall-value {
            font-size: 100px;
            font-weight: bold;
            color: black;
            line-height: 1;
        }

        .caracteristicas-bloqueadas {
            background-color: #111;
            color: #fff;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-top: 20px;
        }

        .caracteristicas-bloqueadas .btn-login {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #2196f3;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .caracteristicas-bloqueadas .btn-login:hover {
            background-color: #1976d2;
        }
    </style>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '
    <div class="caracteristicas-bloqueadas">
        <p>🔒 Para visualizar as características completas do atleta, você precisa estar logado.</p>
        <a href="login.php" class="btn-login">Fazer login</a>
    </div>';
} else {
    // Buscar posição do atleta
    $query_pos = "SELECT posicao FROM atletas WHERE id = :id_atleta";
    $stmt_pos = $db->prepare($query_pos);
    $stmt_pos->bindParam(':id_atleta', $id, PDO::PARAM_INT);
    $stmt_pos->execute();
    $posicao = $stmt_pos->fetchColumn();

    $query_carac = "SELECT * FROM caracteristicas WHERE id_atleta = :id_atleta";
    $stmt_carac = $db->prepare($query_carac);
    $stmt_carac->bindParam(':id_atleta', $id, PDO::PARAM_INT);
    $stmt_carac->execute();
    $carac = $stmt_carac->fetch(PDO::FETCH_ASSOC);

    function renderBar($label, $value) {
        $val = max(0, min(100, intval($value)));

        $hue = 120;
        $saturation = 100;
        $lightness = 40;

        if ($val >= 100) {
            $hue = 120;
            $lightness = 5;
        } elseif ($val >= 90) {
            $hue = 120;
            $lightness = 15 + (100 - $val);
        } elseif ($val >= 80) {
            $hue = 120;
            $lightness = 35 + (90 - $val);
        } elseif ($val >= 70) {
            $hue = 100;
            $lightness = 45;
        } elseif ($val >= 60) {
            $hue = 55;
            $lightness = 45;
        } elseif ($val >= 50) {
            $hue = 35;
            $lightness = 45;
        } elseif ($val >= 40) {
            $hue = 20;
            $lightness = 42;
        } elseif ($val >= 30) {
            $hue = 5;
            $lightness = 40;
        } else {
            $hue = 0;
            $lightness = 32;
        }

        $color = "hsl($hue, {$saturation}%, {$lightness}%)";

        echo "<div class='stat-label'>{$label}</div>";
        echo "<div class='stat-bar'>";
        echo "<div class='stat-fill' style='width: {$val}%; background-color: {$color};'>{$val}</div>";
        echo "</div>";
    }

    if ($carac) {
        echo "<div class='caracteristicas-container'>";

        if (strtolower(trim($posicao)) === "goleiro") {
            echo "<div class='caracteristicas-coluna'>";
            renderBar("Passe", $carac['passe']);
            renderBar("Jogo Aéreo", $carac['jogo_aereo']);
            renderBar("Reflexo", $carac['reflexo_gk']);
            renderBar("Rebote", $carac['rebote_gk']);
            echo "</div>";

            echo "<div class='caracteristicas-coluna'>";
            renderBar("Posicionamento", $carac['posicionamento_gk']);
            renderBar("Saída do Gol", $carac['saida_gol_gk']);
            renderBar("Impulsão", $carac['impulsao_gk']);
            renderBar("Pênaltis", $carac['penaltis_gk']);
            echo "</div>";
        } else {
            echo "<div class='caracteristicas-coluna'>";
            renderBar("Finalização", $carac['finalizacao']);
            renderBar("Drible", $carac['drible']);
            renderBar("Passe", $carac['passe']);
            renderBar("Aceleração", $carac['aceleracao']);
            echo "</div>";

            echo "<div class='caracteristicas-coluna'>";
            renderBar("Condução", $carac['conducao']);
            renderBar("Desarme", $carac['desarme']);
            renderBar("Interceptação", $carac['interceptacao']);
            renderBar("Jogo Aéreo", $carac['jogo_aereo']);
            echo "</div>";
        }

        echo "<div class='caracteristicas-coluna coluna-direita'>";
        echo "<div class='overall-container'>";
        echo "<div class='overall-label'>AllScout Index</div>";
        echo "<div class='overall-value'>" . (isset($carac['overall']) ? round($carac['overall'], 1) : "--") . "</div>";
        echo "</div>";
        echo "</div>";

        echo "</div>"; // fecha .caracteristicas-container
    } else {
        echo "<p>Características não cadastradas para este atleta.</p>";
    }
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
