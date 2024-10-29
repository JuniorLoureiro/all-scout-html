function filterClubes() {
    const filter = document.getElementById('search-clube').value.toLowerCase();
    const items = document.querySelectorAll('.item-clube');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
}

function editarClube(id) {
    // Encontra os dados do clube pelo ID
    const clube = clubes.find(clube => clube.id === id);

    if (clube) {
        // Preenche os campos do formulário com os dados do clube
        document.getElementById('clube-id').value = clube.id;
        document.getElementById('clube-nome').value = clube.nome;
        document.getElementById('clube-imagem').value = clube.imagem;
        document.getElementById('nomeCompleto').value = clube.nomeCompleto;
        document.getElementById('fundacao').value = clube.fundacao;
        document.getElementById('estadio').value = clube.estadio;
        document.getElementById('capacidade').value = clube.capacidade;
        document.getElementById('presidente').value = clube.presidente;
        document.getElementById('treinador').value = clube.treinador;
        document.getElementById('localizacao').value = clube.localizacao;
        document.getElementById('capitao').value = clube.capitao;
        document.getElementById('tam_elenco').value = clube.tam_elenco;

        // Mostra a seção de edição
        showSection('editar-clube');
    }
}

function salvarClube() {
    const id = document.getElementById('clube-id').value;
    const nome = document.getElementById('clube-nome').value;
    const imagem = document.getElementById('clube-imagem').value;
    const nomeCompleto = document.getElementById('nomeCompleto').value;
    const ligaId = document.getElementById('liga-id').value;
    const fundacao = document.getElementById('fundacao').value;
    const estadio = document.getElementById('estadio').value;
    const capacidade = document.getElementById('capacidade').value;
    const presidente = document.getElementById('presidente').value;
    const treinador = document.getElementById('treinador').value;
    const localizacao = document.getElementById('localizacao').value;
    const capitao = document.getElementById('capitao').value;
    const tam_elenco = document.getElementById('tam_elenco').value;

    // Determina a URL: edição ou adição
    const url = id ? '../php/editarClube.php' : '../php/adicionarClube.php';
    const data = {
        id,
        nome,
        imagem,
        nomeCompleto,
        liga_id: ligaId,
        fundacao,
        estadio,
        capacidade,
        presidente,
        treinador,
        localizacao,
        capitao,
        tam_elenco
    };

    // Faz uma requisição AJAX para salvar ou editar
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Clube salvo com sucesso!');
            showSection('clubes');
            // Recarregar a lista de clubes
            location.reload();
        } else {
            alert('Erro ao salvar clube: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar salvar o clube.');
    });
}

function cancelarClube() {
    showSection('clubes');
}

function excluirClube() {
    // Obtém o clube selecionado
    const clubeSelecionado = document.querySelector('.item-clube.selecionado');
    if (!clubeSelecionado) {
        alert('Selecione um clube para excluir.');
        return;
    }

    // Pega o ID do clube
    const clubeId = clubeSelecionado.getAttribute('data-id');

    // Confirmação de exclusão
    if (confirm('Tem certeza que deseja excluir este clube?')) {
        // Faz uma requisição AJAX para o script PHP de exclusão
        fetch('../php/excluirClube.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: clubeId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Clube excluído com sucesso!');
                // Remove o clube da lista
                clubeSelecionado.remove();
            } else {
                alert('Erro ao excluir clube: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao tentar excluir o clube.');
        });
    }
}

function adicionarClube() {
    // Limpa os campos do formulário de edição
    document.getElementById('clube-id').value = '';
    document.getElementById('clube-nome').value = '';
    document.getElementById('clube-imagem').value = '';
    document.getElementById('nomeCompleto').value = '';
    document.getElementById('fundacao').value = '';
    document.getElementById('estadio').value = '';
    document.getElementById('capacidade').value = '';
    document.getElementById('presidente').value = '';
    document.getElementById('treinador').value = '';
    document.getElementById('localizacao').value = '';
    document.getElementById('capitao').value = '';
    document.getElementById('tam_elenco').value = '';

    // Mostra a tela de edição
    showSection('editar-clube');
}

function carregarLigas() {
    fetch('../php/obterLigas.php')
        .then(response => response.json())
        .then(data => {
            const ligaSelect = document.getElementById('liga-id');
            ligaSelect.innerHTML = ''; // Limpa as opções anteriores
            data.forEach(liga => {
                const option = document.createElement('option');
                option.value = liga.id;
                option.textContent = liga.nome; // Ou qualquer outra propriedade que represente o nome
                ligaSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar ligas:', error);
            alert('Ocorreu um erro ao carregar as ligas.');
        });
}

// Chame essa função quando o formulário de edição for aberto
document.addEventListener('DOMContentLoaded', carregarLigas);

function uploadImagemClube() {
    const fileInput = document.getElementById('upload-imagem-clube');
    const file = fileInput.files[0];
    if (!file) {
        alert('Por favor, selecione uma imagem.');
        return;
    }

    const formData = new FormData();
    formData.append('imagem', file);

    fetch('../php/uploadImagem.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Atualiza o campo de imagem com o caminho do arquivo salvo
            document.getElementById('clube-imagem').value = result.filePath;
            alert('Imagem carregada com sucesso!');
        } else {
            alert('Erro ao carregar a imagem: ' + result.message);
        }
    })  
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar carregar a imagem.');
    });
}