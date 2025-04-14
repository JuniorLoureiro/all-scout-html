<?php
require '../php/Database.php';
require '../php/usuario.php';
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuário'; 
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Não disponível';
$cpf = isset($_SESSION['cpf']) ? $_SESSION['cpf'] : 'Não disponível';
$cep = isset($_SESSION['cep']) ? $_SESSION['cep'] : 'Não disponível';
$cidade = isset($_SESSION['cidade']) ? $_SESSION['cidade'] : 'Não disponível';
$logradouro = isset($_SESSION['logradouro']) ? $_SESSION['logradouro'] : 'Não disponível';
$complemento = isset($_SESSION['complemento']) ? $_SESSION['complemento'] : 'Não disponível';
$celular = isset($_SESSION['celular']) ? $_SESSION['celular'] : 'Não disponível';
$data_nascimento = isset($_SESSION['data_nascimento']) ? $_SESSION['data_nascimento'] : 'Não disponível';
$estado = isset($_SESSION['estado']) ? $_SESSION['estado'] : 'Não disponível';
$bairro = isset($_SESSION['bairro']) ? $_SESSION['bairro'] : 'Não disponível';
$numEnd = isset($_SESSION['numEnd']) ? $_SESSION['numEnd'] : 'Não disponível';
$tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'usuario';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Usuario</title>
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

     <!-- Conteúdo Principal -->
     <main class="content-wrapper-atleta">

    <div class="player-name-image">
        <div class="left">
            <h1><?php echo $nome; ?></h1> <!-- Exibe o nome de usuário -->
        </div>
    <div class="right"> <img src="../images/Design sem nome.jpg"> </div>       
    </div>

<!-- Informações do Jogador -->
<section class="user-info">
    <h2>Informações do Usuário</h2>
    <div class="user-info">
        <div><p><label>Nome:</label><span class="value"><?php echo $nome; ?></span></p></div>
        <div><p><label>Email:</label><span class="value"><?php echo $email; ?></span></p></div>
        <div><p><label>CPF:</label><span class="value"><?php echo $cpf; ?></span></p></div>
        <div><p><label>CEP:</label><span class="value"><?php echo $cep; ?></span></p></div>
        <div><p><label>Cidade:</label><span class="value"><?php echo $cidade; ?></span></p></div>
        <div><p><label>Logradouro:</label><span class="value"><?php echo $logradouro; ?></span></p></div>
        <div><p><label>Complemento:</label><span class="value"><?php echo $complemento; ?></span></p></div>
        <div><p><label>Celular:</label><span class="value"><?php echo $celular; ?></span></p></div>
        <?php
            // Supondo que a variável $dataNascimento armazena a data de nascimento no formato 'YYYY-MM-DD'
            $dataNascimento = $_SESSION['data_nascimento'];
            // Converte a data de nascimento em um objeto DateTime
            $dataNascimentoObj = new DateTime($dataNascimento);
            $dataFormatada = $dataNascimentoObj->format('d / m / Y');
        ?>
        <div><p><label>Data de Nascimento:</label><span class="value"><?php echo $dataFormatada; ?></span></p></div>
        <div><p><label>Estado:</label><span class="value"><?php echo $estado; ?></span></p></div>
        <div><p><label>Bairro:</label><span class="value"><?php echo $bairro; ?></span></p></div>
        <div><p><label>Número:</label><span class="value"><?php echo $numEnd; ?></span></p></div>

        <h2></h2>

        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
            <form method="POST" action="/all-scout-html/php/logout.php">
                <button type="submit" class="login-button">Sair da Conta</button>
            </form>
            <form method="POST" action="/all-scout-html/php/deleteuser.php" onsubmit="return confirmarExclusao()">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                <button type="submit" class="login-button">Deletar Usuário</button>
            </form>
        </div>
    </div>

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
    <script>
    function confirmarExclusao() {
        return confirm("Tem certeza que deseja deletar sua conta? Essa ação não poderá ser desfeita.");
    }
    </script>
    <script src="../js/vlibras.js"></script>
    <script src="../js/fontAccessibility.js"></script>
</body>
</html>
