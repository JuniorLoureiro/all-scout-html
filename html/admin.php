<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
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
            <input class="search-style" type="text" id="search-atleta" placeholder="Pesquisar atleta..." oninput="filterAtletas()">
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
                            <strong>ID: ${atleta.id}</strong> | ${atleta.nome} - ${atleta.posicao} - ${atleta.clube} - Nº ${atleta.numero}
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
  <div class="editar-atleta-container">

    <!-- Lado Esquerdo: Formulário -->
    <form class="edit-atleta" id="editar-form" enctype="multipart/form-data">
      <label class="text-edit-atleta" for="id">ID:</label>
      <input class="input-edit-atleta" type="text" id="atleta-id" name="id" readonly>

      <label class="text-edit-atleta" for="nome">Nome:</label>
      <input class="input-edit-atleta" type="text" id="atleta-nome" name="nome">

      <label class="text-edit-atleta" for="nacionalidade">Nacionalidade:</label>
      <input class="input-edit-atleta" type="text" id="nacionalidade" name="nacionalidade">

      <label class="text-edit-atleta" for="data_nascimento_atleta">Data de Nascimento:</label>
      <input class="input-edit-atleta" type="date" id="data_nascimento_atleta" name="data_nascimento_atleta">

      <label class="text-edit-atleta" for="altura">Altura:</label>
      <input class="input-edit-atleta" type="text" id="altura" name="altura">

      <label class="text-edit-atleta" for="perna_dominante">Perna Dominante:</label>
      <input class="input-edit-atleta" type="text" id="perna_dominante" name="perna_dominante">

      <label class="text-edit-atleta" for="posicao">Posição:</label>
      <input class="input-edit-atleta" type="text" id="posicao" name="posicao">

      <label class="text-edit-atleta" for="clube">Clube:</label>
      <input class="input-edit-atleta" type="text" id="clube" name="clube">

      <label class="text-edit-atleta" for="numero">Número:</label>
      <input class="input-edit-atleta" type="text" id="numero" name="numero">

      <label class="text-edit-atleta" for="imagem">Imagem:</label>
      <input class="input-edit-atleta" type="text" id="atleta-imagem" name="imagem" readonly>
      <input class="file-edit-atleta" type="file" id="upload-imagem-atleta" accept="image/*" onchange="uploadImagemAtleta()">

    <button class="button-edit-atleta" type="button" onclick="salvarAtleta()">Salvar</button>
    <button class="button-edit-atleta" type="button" onclick="cancelarAtleta()">Cancelar</button>
    </form>

    <!-- Lado Direito: Espaço para conteúdo adicional -->
    <div class="editar-atleta-direita">
    <button class="button-abre-caracteristicas" type="button" onclick="mostrarCaracteristicasAtleta()">Editar Características Atleta</button>
    <img src="../images/logo.png" alt="Logo" class="logo-edicao">
    
      <div id="caracteristicas-atleta" style="display: none;">
        <h3>Características do Atleta</h3>
        <form id="form-caracteristicas-atleta" onsubmit="salvarCaracteristicas(); return false;">
          <input type="hidden" id="caract-id-atleta" name="id_atleta">

          <label for="caract-posicao">Posição:</label>
          <input type="text" id="caract-posicao" name="posicao" readonly><br><br>

          <!-- Jogador de linha -->
          <div class="campo-linha campo-somente-linha">
            <label>Finalização: <input type="number" id="caract-finalizacao" name="finalizacao" min="0" max="100"></label><br>
            <label>Drible: <input type="number" id="caract-drible" name="drible" min="0" max="100"></label><br>
            <label>Aceleração: <input type="number" id="caract-aceleracao" name="aceleracao" min="0" max="100"></label><br>
            <label>Condução: <input type="number" id="caract-conducao" name="conducao" min="0" max="100"></label><br>
            <label>Desarme: <input type="number" id="caract-desarme" name="desarme" min="0" max="100"></label><br>
            <label>Interceptação: <input type="number" id="caract-interceptacao" name="interceptacao" min="0" max="100"></label><br>
          </div>

          <!-- Atributos comuns -->
          <div class="campo-linha">
            <label>Passe: <input type="number" id="caract-passe" name="passe" min="0" max="100"></label><br>
            <label>Jogo Aéreo: <input type="number" id="caract-jogo-aereo" name="jogo_aereo" min="0" max="100"></label><br>
          </div>

          <!-- Goleiro -->
          <div class="campo-goleiro" style="display: none;">
            <label>Reflexo (GK): <input type="number" id="caract-reflexo-gk" name="reflexo_gk" min="0" max="100"></label><br>
            <label>Rebote (GK): <input type="number" id="caract-rebote-gk" name="rebote_gk" min="0" max="100"></label><br>
            <label>Posicionamento (GK): <input type="number" id="caract-posicionamento-gk" name="posicionamento_gk" min="0" max="100"></label><br>
            <label>Saída do Gol (GK): <input type="number" id="caract-saida-gol-gk" name="saida_gol_gk" min="0" max="100"></label><br>
            <label>Impulsão (GK): <input type="number" id="caract-impulsao-gk" name="impulsao_gk" min="0" max="100"></label><br>
            <label>Pênaltis (GK): <input type="number" id="caract-penaltis-gk" name="penaltis_gk" min="0" max="100"></label><br>
          </div>

          <button type="submit" class="button-salva-caracteristicas">Salvar Características</button>
          <button type="button" onclick="fecharCaracteristicas()" class="btn-fechar-caracteristicas">×</button>
          

        </form>
      </div>
    </div>

  </div>
</div>






        <!-- Conteúdo dos Clubes -->
        <div class="tab-content" id="clubes" style="display: none;">
            <h2>Clubes</h2>
            <input class="search-style" type="text" id="search-clube" placeholder="Pesquisar clube..." oninput="filterClubes()">
            <div class="lista-clubes">
                <!-- Lista de clubes será preenchida aqui via PHP -->
                <?php
                try {
                    // Consulta para buscar todos os clubes
                    $stmt = $db->prepare("SELECT id, nome, nomeCompleto, imagem, fundacao, estadio, estadio_img, capacidade, presidente, treinador, localizacao, capitao, tam_elenco FROM clubes");
                    $stmt->execute();
                    $clubes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "<p>Erro ao carregar clubes: " . $e->getMessage() . "</p>";
                    $clubes = [];
                }
                ?>

                <script>
                    // Passando os dados de clubes para o JavaScript
                    const clubes = <?php echo json_encode($clubes); ?>;
                    const listaClubes = document.querySelector('.lista-clubes');

                    clubes.forEach(clube => {
                        const item = document.createElement('div');
                        item.classList.add('item-clube');
                        item.setAttribute('data-id', clube.id);
                        item.innerHTML = `
                            <strong>ID: ${clube.id}</strong> | ${clube.nome} - ${clube.nomeCompleto}<br>
                            <img src="${clube.imagem}" alt="${clube.nome}" style="width: 100px; height: auto;"><br>
                        `;
                        item.onclick = () => selecionarClube(item);
                        item.ondblclick = () => editarClube(clube.id);
                        listaClubes.appendChild(item);
                    });

                    function selecionarClube(item) {
                        // Remove a seleção de todos os itens
                        document.querySelectorAll('.item-clube').forEach(i => i.classList.remove('selecionado'));
                        // Adiciona a classe 'selecionado' ao item clicado
                        item.classList.add('selecionado');
                    }
                </script>
            </div>
            <button class="tab-button" onclick="adicionarClube()">Adicionar Clube</button>
            <button class="tab-button" onclick="excluirClube()">Excluir Clube</button>
        </div>


        <!-- Tela de edição do clube -->
        <div class="tab-content" id="editar-clube" style="display: none;">
            <form class="edit-clube" id="editar-form" enctype="multipart/form-data">
                <label class="text-edit-clube" for="id">ID:</label>
                <input class="input-edit-clube" type="text" id="clube-id" name="id" readonly><br>
                <label class="text-edit-clube" for="nome">Nome:</label>
                <input class="input-edit-clube" type="text" id="clube-nome" name="nome"><br>
                <label class="text-edit-clube" for="nomeCompleto">Nome Completo:</label>
                <input class="input-edit-clube" type="text" id="nomeCompleto" name="nomeCompleto"><br>
                <label class="text-edit-clube" for="fundacao">Fundação:</label>
                <input class="input-edit-clube" type="number" id="fundacao" name="fundacao"><br>
                <label class="text-edit-clube" for="estadio">Estádio:</label>
                <input class="input-edit-clube" type="text" id="estadio" name="estadio"><br>
                <label class="text-edit-clube" for="capacidade">Capacidade:</label>
                <input class="input-edit-clube" type="number" id="capacidade" name="capacidade"><br>
                <label class="text-edit-clube" for="presidente">Presidente:</label>
                <input class="input-edit-clube" type="text" id="presidente" name="presidente"><br>
                <label class="text-edit-clube" for="treinador">Treinador:</label>
                <input class="input-edit-clube" type="text" id="treinador" name="treinador"><br>
                <label class="text-edit-clube" for="localizacao">Localização:</label>
                <input class="input-edit-clube" type="text" id="localizacao" name="localizacao"><br>
                <label class="text-edit-clube" for="capitao">Capitão:</label>
                <input class="input-edit-clube" type="text" id="capitao" name="capitao"><br>
                <label class="text-edit-clube" for="tam_elenco">Tamanho do Elenco:</label>
                <input class="input-edit-clube" type="number" id="tam_elenco" name="tam_elenco"><br>
                <label class="text-edit-clube" for="liga">Liga:</label>
                <select id="liga-id" name="liga_id"></select><br>
                <label class="text-edit-clube" for="imagem">Imagem:</label>
                <input class="input-edit-clube" type="text" id="clube-imagem" name="imagem" readonly>
                <input class="file-edit-clube" type="file" id="upload-imagem-clube" accept="image/*" onchange="uploadImagemClube()"><br>
                <!-- Botões dentro de uma div separada -->
                <div class="buttons-container">
                    <button class="button-edit-clube" type="button" onclick="salvarClube()">Salvar</button>
                    <button class="button-edit-clube" type="button" onclick="cancelarClube()">Cancelar</button>
                </div>
            </form>
        </div>

        <!-- Conteúdo dos Usuários -->
        <div class="tab-content" id="usuarios">
            <h2>Usuários</h2>
            <input class="search-style" type="text" id="search-usuario" placeholder="Pesquisar usuário..." oninput="filterUsuarios()">
            <div class="lista-usuarios">
                <!-- Lista de usuários será preenchida aqui via PHP -->
                <?php
                try {
                    // Consulta para buscar todos os usuários
                    $stmt = $db->prepare("SELECT id, nome, email, cpf, senha, cep, cidade, logradouro, complemento, username, celular, data_nascimento, estado, bairro, numEnd, tipo_usuario FROM usuarios");
                    $stmt->execute();
                    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "<p>Erro ao carregar usuários: " . $e->getMessage() . "</p>";
                    $usuarios = [];
                }
                ?>

                <script>
                    // Passando os dados de usuários para o JavaScript
                    const usuarios = <?php echo json_encode($usuarios); ?>;
                    const listaUsuarios = document.querySelector('.lista-usuarios');

                    usuarios.forEach(usuario => {
                        const item = document.createElement('div');
                        item.classList.add('item-usuario');
                        item.setAttribute('data-id', usuario.id);
                        item.innerHTML = `
                            <strong>ID: ${usuario.id}</strong> | ${usuario.nome} - ${usuario.username} - ${usuario.cpf} - ${usuario.tipo_usuario}
                        `;
                        item.onclick = () => selecionarUsuario(item);
                        item.ondblclick = () => editarUsuario(usuario.id);
                        listaUsuarios.appendChild(item);
                    });

                    function selecionarUsuario(item) {
                        // Remove a seleção de todos os itens
                        document.querySelectorAll('.item-usuario').forEach(i => i.classList.remove('selecionado'));
                        // Adiciona a classe 'selecionado' ao item clicado
                        item.classList.add('selecionado');
                    }
                </script>
            </div>
            <button class="tab-button" onclick="adicionarUsuario()">Adicionar Usuário</button>
            <button class="tab-button" onclick="excluirUsuario()">Excluir Usuário</button>
        </div>

        <!-- Tela de edição do usuário -->
        <div class="tab-content" id="editar-usuario" style="display: none;">   
            <form class="edit-usuario" id="editar-form" enctype="multipart/form-data">
                <label class="text-edit-usuario" for="id">ID:</label>
                <input class="input-edit-usuario" type="text" id="usuario-id" name="id" readonly><br>
                <label class="text-edit-usuario" for="nome">Nome:</label>
                <input class="input-edit-usuario" type="text" id="usuario-nome" name="nome"><br>
                <label class="text-edit-usuario" for="email">Email:</label>
                <input class="input-edit-usuario" type="email" id="email" name="email"><br>
                <label class="text-edit-usuario" for="username">Username:</label>
                <input class="input-edit-usuario" type="text" id="username" name="username"><br>
                <label class="text-edit-usuario" for="senha">Senha:</label>
                <input class="input-edit-usuario" type="password" id="senha" name="senha" placeholder="••••••••"><br>
                <label class="text-edit-usuario" for="cpf">CPF:</label>
                <input class="input-edit-usuario" type="text" id="cpf" name="cpf"><br>
                <label class="text-edit-usuario" for="data_nascimento_usuario">Data de Nascimento:</label>
                <input class="input-edit-usuario" type="date" id="data_nascimento_usuario" name="data_nascimento_usuario"><br>
                <label class="text-edit-usuario" for="celular">Celular:</label>
                <input class="input-edit-usuario" type="text" id="celular" name="celular"><br>
                <label class="text-edit-usuario" for="cep">CEP:</label>
                <input class="input-edit-usuario" type="text" id="cep" name="cep"><br>
                <label class="text-edit-usuario" for="cidade">Cidade:</label>
                <input class="input-edit-usuario" type="text" id="cidade" name="cidade"><br>
                <label class="text-edit-usuario" for="estado">Estado:</label>
                <input class="input-edit-usuario" type="text" id="estado" name="estado"><br>
                <label class="text-edit-usuario" for="bairro">Bairro:</label>
                <input class="input-edit-usuario" type="text" id="bairro" name="bairro"><br>
                <label class="text-edit-usuario" for="logradouro">Logradouro:</label>
                <input class="input-edit-usuario" type="text" id="logradouro" name="logradouro"><br>
                <label class="text-edit-usuario" for="numEnd">Número:</label>
                <input class="input-edit-usuario" type="text" id="numEnd" name="numEnd"><br>
                <label class="text-edit-usuario" for="complemento">Complemento:</label>
                <input class="input-edit-usuario" type="text" id="complemento" name="complemento"><br>
                <label class="text-edit-usuario" for="tipo_usuario">Tipo de Usuário:</label>
                <select class="input-edit-usuario" id="tipo_usuario" name="tipo_usuario">
                    <option value="usuario">usuario</option>
                    <option value="admin">admin</option>
                </select><br>
                <button class="button-edit-usuario" type="button" onclick="salvarUsuario()">Salvar</button>
                <button class="button-edit-usuario" type="button" onclick="cancelarUsuario()">Cancelar</button>
            </form>
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

<script>
    function showSection(sectionId) {
    // Esconde todas as seções
    const sections = document.querySelectorAll('.tab-content');
    sections.forEach(section => section.style.display = 'none');

    // Exibe a seção desejada
    const sectionToShow = document.getElementById(sectionId);
    if (sectionToShow) {
        sectionToShow.style.display = 'block';
    }

    // Oculta a div de características do atleta sempre que mudar de aba
    document.getElementById('caracteristicas-atleta').style.display = 'none';
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/adminClubes.js"></script>
<script src="../js/adminAtletas.js"></script>
<script src="../js/adminUsuarios.js"></script>
<script src="../js/vlibras.js"></script>
<script src="../js/fontAccessibility.js"></script>
<script src="../js/desfavorito.js"></script>
<script src="../js/sintaxeInput.js"></script>
<script src="../js/buscarEndereco.js"></script>

</body>
</html>