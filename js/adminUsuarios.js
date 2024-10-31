function filterUsuarios() {
    const filter = document.getElementById('search-usuario').value.toLowerCase();
    const items = document.querySelectorAll('.item-usuario');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
}

function editarUsuario(id) {
    const usuario = usuarios.find(usuario => usuario.id === id);

    if (usuario) {
        document.getElementById('usuario-id').value = usuario.id;
        document.getElementById('usuario-nome').value = usuario.nome;
        document.getElementById('email').value = usuario.email;
        document.getElementById('tipo-usuario').value = usuario.tipo_usuario;
        document.getElementById('cpf').value = usuario.cpf; // Adicionado
        document.getElementById('celular').value = usuario.celular; // Adicionado
        document.getElementById('cep').value = usuario.cep; // Adicionado
        document.getElementById('cidade').value = usuario.cidade; // Adicionado
        document.getElementById('estado').value = usuario.estado; // Adicionado
        document.getElementById('bairro').value = usuario.bairro; // Adicionado
        document.getElementById('logradouro').value = usuario.logradouro; // Adicionado
        document.getElementById('numEnd').value = usuario.numEnd; // Adicionado
        document.getElementById('complemento').value = usuario.complemento; // Adicionado
        document.getElementById('data_nascimento').value = usuario.data_nascimento; // Adicionado

        showSection('editar-usuario');
    }
}

function salvarUsuario() {
    const id = document.getElementById('usuario-id').value;
    const nome = document.getElementById('usuario-nome').value;
    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value; // Adicionado
    const tipoUsuario = document.getElementById('tipo-usuario').value;
    const cpf = document.getElementById('cpf').value; // Adicionado
    const celular = document.getElementById('celular').value; // Adicionado
    const cep = document.getElementById('cep').value; // Adicionado
    const cidade = document.getElementById('cidade').value; // Adicionado
    const estado = document.getElementById('estado').value; // Adicionado
    const bairro = document.getElementById('bairro').value; // Adicionado
    const logradouro = document.getElementById('logradouro').value; // Adicionado
    const numEnd = document.getElementById('numEnd').value; // Adicionado
    const complemento = document.getElementById('complemento').value; // Adicionado

    const url = id ? '../php/editarUsuario.php' : '../php/adicionarUsuario.php';
    const data = {
        id,
        nome,
        email,
        username,
        tipo_usuario: tipoUsuario,
        cpf,
        celular,
        cep,
        cidade,
        estado,
        bairro,
        logradouro,
        numEnd,
        complemento
    };

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Usuário salvo com sucesso!');
            showSection('usuarios');
            location.reload();
        } else {
            alert('Erro ao salvar usuário: ' + result.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar salvar o usuário.');
    });
}

function cancelarUsuario() {
    showSection('usuarios');
}

function excluirUsuario() {
    const usuarioSelecionado = document.querySelector('.item-usuario.selecionado');
    if (!usuarioSelecionado) {
        alert('Selecione um usuário para excluir.');
        return;
    }

    const usuarioId = usuarioSelecionado.getAttribute('data-id');

    if (confirm('Tem certeza que deseja excluir este usuário?')) {
        fetch('../php/excluirUsuario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: usuarioId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Usuário excluído com sucesso!');
                usuarioSelecionado.remove();
            } else {
                alert('Erro ao excluir usuário: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao tentar excluir o usuário.');
        });
    }
}

function adicionarUsuario() {
    document.getElementById('usuario-id').value = ''; // Limpa o ID do usuário
    document.getElementById('usuario-nome').value = ''; // Limpa o nome do usuário
    document.getElementById('email').value = ''; // Limpa o email do usuário
    document.getElementById('cpf').value = ''; // Limpa o CPF
    document.getElementById('celular').value = ''; // Limpa o celular
    document.getElementById('cep').value = ''; // Limpa o CEP
    document.getElementById('cidade').value = ''; // Limpa a cidade
    document.getElementById('estado').value = ''; // Limpa o estado
    document.getElementById('bairro').value = ''; // Limpa o bairro
    document.getElementById('logradouro').value = ''; // Limpa o logradouro
    document.getElementById('numEnd').value = ''; // Limpa o número do endereço
    document.getElementById('complemento').value = ''; // Limpa o complemento
    document.getElementById('data_nascimento').value = ''; // Limpa a data de nascimento
    document.getElementById('tipo-usuario').value = ''; // Limpa o tipo de usuário

    showSection('editar-usuario'); // Mostra a seção de edição de usuário
}

function uploadImagemUsuario() {
    const fileInput = document.getElementById('upload-imagem-usuario');
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
            document.getElementById('usuario-imagem').value = result.filePath;
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