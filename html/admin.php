<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Favoritos</title>
</head>
<body>

<!-- Cabeçalho -->
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
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Pesquise...">
        </div>
        <div class="right-nav">
            <?php
                // Verifica se a sessão já está iniciada
                if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<a href="perfilUser.php" class="account-button">' . htmlspecialchars($_SESSION['username']) . '</a>';
            } else {
                echo '<a href="login.php" class="account-button">Minha Conta</a>';
            }
            ?>
        </div>
    </div>
</header>

<!-- Acessibilidade de Fonte -->
<div class="font-controls">
    <button id="decrease-font" aria-label="Diminuir tamanho da fonte">A-</button>
    <button id="increase-font" aria-label="Aumentar tamanho da fonte">A+</button>
</div>

<!-- Conteúdo aqui -->
<div class="background-admin">
<h5 class="tituloAdm">Administrador</h5>
    <nav class="nav-admin">
        <!-- Botões para alterar a tela -->
        <button class="tab-button" onclick="showSection('atletas')">Atletas</button>
        <button class="tab-button" onclick="showSection('clubes')">Clubes</button>
        <button class="tab-button" onclick="showSection('usuarios')">Usuários</button>
    </nav>

    <section class="section-admin">
        <!-- Conteúdo que vai ser alterado -->
        <!-- Conteúdo dos Atletas -->
        <div class="tab-content" id="atletas">
            <h2>Atletas</h2>
            <input type="text" id="search-admin" placeholder="Pesquisar atleta..." oninput="filterAtletas()">
            <div class="lista-atletas">
                <!-- Lista de atletas será preenchida aqui via PHP -->
                <?php
                // Conexão com o banco de dados usando PDO
                include('../php/Database.php');
                $conn = new Database();
                $db = $conn->getConnection();

                try {
                    // Consulta para buscar todos os atletas
                    $stmt = $db->prepare("SELECT id, nome, nacionalidade, data_nascimento, altura, perna_dominante, posicao, clube, numero, imagem FROM atletas");
                    $stmt->execute();
                    $atletas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "<p>Erro ao carregar atletas: " . $e->getMessage() . "</p>";
                    $atletas = [];
                }                
                ?>

                <script>
                    // Passando os dados de atletas para o JavaScript
                    const atletas = <?php echo json_encode($atletas); ?>;
                    const listaAtletas = document.querySelector('.lista-atletas');

                    atletas.forEach(atleta => {
                        const item = document.createElement('div');
                        item.classList.add('item-atleta');
                        item.setAttribute('data-id', atleta.id);
                        item.innerHTML = `
                            <strong>${atleta.nome}</strong> - ${atleta.posicao} - ${atleta.clube} - Nº ${atleta.numero}
                        `;
                        item.onclick = () => selecionarAtleta(item);
                        item.ondblclick = () => editarAtleta(atleta.id);
                        listaAtletas.appendChild(item);
                    });

                    function selecionarAtleta(item) {
                        // Remove a seleção de todos os itens
                        document.querySelectorAll('.item-atleta').forEach(i => i.classList.remove('selecionado'));
                        // Adiciona a classe 'selecionado' ao item clicado
                        item.classList.add('selecionado');
                    }
                </script>
            </div>
            <button class="tab-button" onclick="adicionarAtleta()">Adicionar Atleta</button>
            <button class="tab-button" onclick="excluirAtleta()">Excluir Atleta</button>
        </div>

        <!-- Tela de edição do atleta -->
        <div class="tab-content" id="editar-atleta" style="display: none;">
            <h2>Editar Atleta</h2>
            <form id="editar-form" enctype="multipart/form-data">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" readonly><br>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome"><br>
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" id="nacionalidade" name="nacionalidade"><br>
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento"><br>
                <label for="altura">Altura:</label>
                <input type="text" id="altura" name="altura"><br>
                <label for="perna_dominante">Perna Dominante:</label>
                <input type="text" id="perna_dominante" name="perna_dominante"><br>
                <label for="posicao">Posição:</label>
                <input type="text" id="posicao" name="posicao"><br>
                <label for="clube">Clube:</label>
                <input type="text" id="clube" name="clube"><br>
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero"><br>
                <label for="imagem">Imagem:</label>
                <input type="text" id="imagem" name="imagem" readonly>
                <input type="file" id="upload-imagem" accept="image/*" onchange="uploadImagem()"><br>
                <button type="button" onclick="salvarEdicao()">Salvar</button>
                <button type="button" onclick="cancelarEdicao()">Cancelar</button>
            </form>
        </div>

        <div class="tab-content" id="clubes" style="display: none;">
            <h2>Clubes</h2>
            <p>Conteúdo relacionado aos clubes vai aqui.</p>
        </div>
        <div class="tab-content" id="usuarios" style="display: none;">
            <h2>Usuários</h2>
            <p>Conteúdo relacionado aos usuários vai aqui.</p>
        </div>
    </section>
</div>

<!-- Roda Pé -->
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

<!-- Scripts JS -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="../js/adminAtletas.js"></script>
<script src="../js/vlibras.js"></script>
<script src="../js/fontAccessibility.js"></script>
<script src="../js/desfavorito.js"></script>

</body>
</html>