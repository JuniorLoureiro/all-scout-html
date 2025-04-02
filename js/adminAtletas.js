function filterAtletas() {
    const filter = document.getElementById('search-atleta').value.toLowerCase();
    const items = document.querySelectorAll('.item-atleta');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
}

function editarAtleta(id) {
    // Encontra os dados do atleta pelo ID
    const atleta = atletas.find(atleta => atleta.id === id);

    if (atleta) {
        // Preenche os campos do formulário com os dados do atleta
        document.getElementById('atleta-id').value = atleta.id;
        document.getElementById('atleta-nome').value = atleta.nome;
        document.getElementById('nacionalidade').value = atleta.nacionalidade;
        document.getElementById('data_nascimento_atleta').value = atleta.data_nascimento;
        document.getElementById('altura').value = atleta.altura;
        document.getElementById('perna_dominante').value = atleta.perna_dominante;
        document.getElementById('posicao').value = atleta.posicao; // Agora ID da posição
        document.getElementById('clube').value = atleta.clube;
        document.getElementById('numero').value = atleta.numero;
        document.getElementById('atleta-imagem').value = atleta.imagem;
        
        // Mostra a seção de edição
        showSection('editar-atleta');
    }
}

function salvarAtleta() {
    const id = document.getElementById('atleta-id').value;
    const nome = document.getElementById('atleta-nome').value;
    const nacionalidade = document.getElementById('nacionalidade').value;
    const dataNascimento = document.getElementById('data_nascimento_atleta').value;
    const altura = document.getElementById('altura').value;
    const pernaDominante = document.getElementById('perna_dominante').value;
    const posicao = document.getElementById('posicao').value; // ID da posição
    const clube = document.getElementById('clube').value;
    const numero = document.getElementById('numero').value;
    const imagem = document.getElementById('atleta-imagem').value;

    // Determina a URL: edição ou adição
    const url = id ? '../php/editarAtleta.php' : '../php/adicionarAtleta.php';
    const data = {
        id,
        nome,
        nacionalidade,
        data_nascimento: dataNascimento,
        altura, 
        perna_dominante: pernaDominante,
        posicao, // Passa o ID da posição
        clube,
        numero,
        imagem
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
            alert('Atleta salvo com sucesso!');
            showSection('atletas');
            // Recarregar a lista de atletas
            location.reload();
        } else {
            alert('Erro ao salvar atleta: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar salvar o atleta.');
    });
}

function cancelarAtleta() {
    showSection('atletas');
}

function excluirAtleta() {
    // Obtém o atleta selecionado
    const atletaSelecionado = document.querySelector('.item-atleta.selecionado');
    if (!atletaSelecionado) {
        alert('Selecione um atleta para excluir.');
        return;
    }

    // Pega o ID do atleta
    const atletaId = atletaSelecionado.getAttribute('data-id');

    // Confirmação de exclusão
    if (confirm('Tem certeza que deseja excluir este atleta?')) {
        // Faz uma requisição AJAX para o script PHP de exclusão
        fetch('../php/excluirAtleta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: atletaId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Atleta excluído com sucesso!');
                // Remove o atleta da lista
                atletaSelecionado.remove();
            } else {
                alert('Erro ao excluir atleta: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao tentar excluir o atleta.');
        });
    }
}

function adicionarAtleta() {
    // Limpa os campos do formulário de edição
    document.getElementById('atleta-id').value = '';
    document.getElementById('atleta-nome').value = '';
    document.getElementById('nacionalidade').value = '';
    document.getElementById('data_nascimento_atleta').value = '';
    document.getElementById('altura').value = '';
    document.getElementById('perna_dominante').value = '';
    document.getElementById('posicao').value = ''; // ID da posição
    document.getElementById('clube').value = '';
    document.getElementById('numero').value = '';
    document.getElementById('atleta-imagem').value = '';

    // Mostra a tela de edição
    showSection('editar-atleta');
}

function uploadImagemAtleta() {
    const fileInput = document.getElementById('upload-imagem-atleta');
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
            document.getElementById('atleta-imagem').value = result.filePath;
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
