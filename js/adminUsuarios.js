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
        document.getElementById("username").value = usuario.username;
        document.getElementById('email').value = usuario.email;
        document.getElementById('tipo_usuario').value = usuario.tipo_usuario;
        document.getElementById('cpf').value = usuario.cpf;
        document.getElementById('celular').value = usuario.celular;
        document.getElementById('cep').value = usuario.cep;
        document.getElementById('cidade').value = usuario.cidade;
        document.getElementById('estado').value = usuario.estado;
        document.getElementById('bairro').value = usuario.bairro;
        document.getElementById('logradouro').value = usuario.logradouro;
        document.getElementById('numEnd').value = usuario.numEnd;
        document.getElementById('complemento').value = usuario.complemento;
        document.getElementById('data_nascimento_usuario').value = usuario.data_nascimento;

        // O campo de senha aparece com asteriscos, mas sem preencher valor real
        document.getElementById('senha').value = '';
        document.getElementById('senha').placeholder = '••••••••';

        showSection('editar-usuario');
    }
}

function salvarUsuario() {
    const id = document.getElementById('usuario-id').value;
    const nome = document.getElementById('usuario-nome').value;
    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const senha = document.getElementById('senha').value; // Senha só será enviada se preenchida
    const tipoUsuario = document.getElementById('tipo_usuario').value;
    const cpf = document.getElementById('cpf').value;
    const celular = document.getElementById('celular').value;
    const cep = document.getElementById('cep').value;
    const cidade = document.getElementById('cidade').value;
    const estado = document.getElementById('estado').value;
    const bairro = document.getElementById('bairro').value;
    const logradouro = document.getElementById('logradouro').value;
    const numEnd = document.getElementById('numEnd').value;
    const complemento = document.getElementById('complemento').value;
    const dataNascimento = document.getElementById('data_nascimento_usuario').value;
    console.log("Enviando para o PHP:", dataNascimento);

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
        complemento,
        data_nascimento: dataNascimento,
    };

    // Só adiciona a senha se for preenchida
    if (senha.trim() !== '') {
        data.senha = senha;
    }

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
    document.getElementById('usuario-id').value = '';
    document.getElementById('usuario-nome').value = '';
    document.getElementById('email').value = '';
    document.getElementById('cpf').value = '';
    document.getElementById('celular').value = '';
    document.getElementById('cep').value = '';
    document.getElementById('cidade').value = '';
    document.getElementById('estado').value = '';
    document.getElementById('bairro').value = '';
    document.getElementById('logradouro').value = '';
    document.getElementById('numEnd').value = '';
    document.getElementById('complemento').value = '';
    document.getElementById('data_nascimento_usuario').value = '';
    document.getElementById('tipo_usuario').value = '';

    // Senha aparece vazia, apenas para adicionar um novo usuário
    document.getElementById('senha').value = '';

    showSection('editar-usuario');
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
