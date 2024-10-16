function favoritar(id, nome, posicao, clube, numero) {
    const data = new FormData();
    data.append('id', id);
    data.append('nome', nome);
    data.append('posicao', posicao);
    data.append('clube', clube);
    data.append('numero', numero);

    fetch('atletas.php', {
        method: 'POST',
        body: data,
    })
    .then(response => response.text())
    .then(data => {
        alert('Atleta favoritado!');
        // Atualiza a página ou o estado da interface, se necessário
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocorreu um erro ao favoritar o atleta.');
    });
}

function desfavoritar(id) {
    const data = new FormData();
    data.append('id_atleta', id);

    fetch('desfavoritar.php', {
        method: 'POST',
        body: data,
    })
    .then(response => response.text())
    .then(data => {
        alert('Atleta desfavoritado!');
        // Atualiza a página ou o estado da interface, se necessário
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocorreu um erro ao desfavoritar o atleta.');
    });
}