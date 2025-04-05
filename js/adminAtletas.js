function filterAtletas() {
    const filter = document.getElementById('search-atleta').value.toLowerCase();
    const items = document.querySelectorAll('.item-atleta');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
}

function editarAtleta(id) {
    const atleta = atletas.find(atleta => atleta.id === id);

    if (atleta) {
        document.getElementById('atleta-id').value = atleta.id;
        document.getElementById('atleta-nome').value = atleta.nome;
        document.getElementById('nacionalidade').value = atleta.nacionalidade;
        document.getElementById('data_nascimento_atleta').value = atleta.data_nascimento;
        document.getElementById('altura').value = atleta.altura;
        document.getElementById('perna_dominante').value = atleta.perna_dominante;
        document.getElementById('posicao').value = atleta.posicao;
        document.getElementById('clube').value = atleta.clube;
        document.getElementById('numero').value = atleta.numero;
        document.getElementById('atleta-imagem').value = atleta.imagem;

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
    const posicao = document.getElementById('posicao').value;
    const clube = document.getElementById('clube').value;
    const numero = document.getElementById('numero').value;
    const imagem = document.getElementById('atleta-imagem').value;

    const url = id ? '../php/editarAtleta.php' : '../php/adicionarAtleta.php';
    const data = {
        id,
        nome,
        nacionalidade,
        data_nascimento: dataNascimento,
        altura,
        perna_dominante: pernaDominante,
        posicao,
        clube,
        numero,
        imagem
    };

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
    const atletaSelecionado = document.querySelector('.item-atleta.selecionado');
    if (!atletaSelecionado) {
        alert('Selecione um atleta para excluir.');
        return;
    }

    const atletaId = atletaSelecionado.getAttribute('data-id');

    if (confirm('Tem certeza que deseja excluir este atleta?')) {
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
    document.getElementById('atleta-id').value = '';
    document.getElementById('atleta-nome').value = '';
    document.getElementById('nacionalidade').value = '';
    document.getElementById('data_nascimento_atleta').value = '';
    document.getElementById('altura').value = '';
    document.getElementById('perna_dominante').value = '';
    document.getElementById('posicao').value = '';
    document.getElementById('clube').value = '';
    document.getElementById('numero').value = '';
    document.getElementById('atleta-imagem').value = '';

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

function atualizarFormularioPorPosicao(posicao) {
    const grupoLinha = document.querySelectorAll('.campo-linha');
    const grupoGoleiro = document.querySelectorAll('.campo-goleiro');

    // Exibe tudo por padrão
    grupoLinha.forEach(el => el.style.display = 'block');
    grupoGoleiro.forEach(el => el.style.display = 'block');

    // Se for goleiro, escondemos apenas os campos que são *exclusivos* de jogador de linha
    if (posicao.toLowerCase() === 'goleiro') {
        document.querySelectorAll('.campo-somente-linha').forEach(el => el.style.display = 'none');
    } else {
        // Se for jogador de linha, escondemos campos exclusivos de goleiro
        grupoGoleiro.forEach(el => el.style.display = 'none');
    }
}

function limparCamposCaracteristicas() {
    const campos = document.querySelectorAll('#caracteristicas-atleta input');
    campos.forEach(input => input.value = '');
}

function mostrarCaracteristicasAtleta() {
    const id = document.getElementById("atleta-id").value;
    const posicao = document.getElementById("posicao").value.toLowerCase();

    document.getElementById("caract-id-atleta").value = id;
    document.getElementById("caract-posicao").value = posicao;

    atualizarFormularioPorPosicao(posicao);

    document.getElementById("caracteristicas-atleta").style.display = "block";

    fetch(`../php/buscarCaracteristicas.php?id_atleta=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.status === "sucesso") {
                const caract = data.dados;

                // Jogador de linha
                document.getElementById("caract-finalizacao").value = caract.finalizacao ?? "";
                document.getElementById("caract-drible").value = caract.drible ?? "";
                document.getElementById("caract-aceleracao").value = caract.aceleracao ?? "";
                document.getElementById("caract-conducao").value = caract.conducao ?? "";
                document.getElementById("caract-passe").value = caract.passe ?? "";
                document.getElementById("caract-desarme").value = caract.desarme ?? "";
                document.getElementById("caract-interceptacao").value = caract.interceptacao ?? "";
                document.getElementById("caract-jogo-aereo").value = caract.jogo_aereo ?? "";

                // Goleiro
                document.getElementById("caract-reflexo-gk").value = caract.reflexo_gk ?? "";
                document.getElementById("caract-rebote-gk").value = caract.rebote_gk ?? "";
                document.getElementById("caract-posicionamento-gk").value = caract.posicionamento_gk ?? "";
                document.getElementById("caract-saida-gol-gk").value = caract.saida_gol_gk ?? "";
                document.getElementById("caract-impulsao-gk").value = caract.impulsao_gk ?? "";
                document.getElementById("caract-penaltis-gk").value = caract.penaltis_gk ?? "";
            } else {
                document.querySelectorAll('#form-caracteristicas-atleta input[type="number"]').forEach(input => {
                    input.value = "";
                });
            }
        });
}

function salvarCaracteristicas() {
    const dados = {
        id_atleta: document.getElementById("caract-id-atleta").value,
        posicao: document.getElementById("caract-posicao").value,
        finalizacao: document.getElementById("caract-finalizacao").value,
        drible: document.getElementById("caract-drible").value,
        aceleracao: document.getElementById("caract-aceleracao").value,
        conducao: document.getElementById("caract-conducao").value,
        passe: document.getElementById("caract-passe").value,
        desarme: document.getElementById("caract-desarme").value,
        interceptacao: document.getElementById("caract-interceptacao").value,
        jogo_aereo: document.getElementById("caract-jogo-aereo").value,
        reflexo_gk: document.getElementById("caract-reflexo-gk").value,
        rebote_gk: document.getElementById("caract-rebote-gk").value,
        posicionamento_gk: document.getElementById("caract-posicionamento-gk").value,
        saida_gol_gk: document.getElementById("caract-saida-gol-gk").value,
        impulsao_gk: document.getElementById("caract-impulsao-gk").value,
        penaltis_gk: document.getElementById("caract-penaltis-gk").value,
    };

    const camposObrigatoriosLinha = ['finalizacao', 'drible', 'aceleracao', 'conducao', 'passe', 'desarme', 'interceptacao', 'jogo_aereo'];
    const camposObrigatoriosGK = ['reflexo_gk', 'rebote_gk', 'posicionamento_gk', 'saida_gol_gk', 'impulsao_gk', 'penaltis_gk', 'passe', 'jogo_aereo'];
    const faltando = [];

    if (dados.posicao.toLowerCase() === 'goleiro') {
        camposObrigatoriosGK.forEach(campo => {
            if (!dados[campo]) faltando.push(campo);
        });
    } else {
        camposObrigatoriosLinha.forEach(campo => {
            if (!dados[campo]) faltando.push(campo);
        });
    }

    if (faltando.length > 0) {
        alert("Preencha todos os campos obrigatórios: " + faltando.join(", "));
        return;
    }

    fetch('../php/salvarCaracteristicas.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(dados)
    })
        .then(response => response.json())
        .then(resultado => {
            alert(resultado.mensagem);
            document.getElementById("caracteristicas-atleta").style.display = "none";
        })
        .catch(erro => {
            console.error('Erro ao salvar características:', erro);
            alert('Erro ao salvar características');
        });
}
