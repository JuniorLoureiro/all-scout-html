function favoritar(id) {
    const data = new FormData();
    data.append('id_atleta', id);

    fetch('favoritar.php', {
        method: 'POST',
        body: data,
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert('Atleta favoritado!');

            const button = document.querySelector(`button[data-id='${id}']`);
            if (button) {
                button.className = 'desfavoritar-button';
                button.setAttribute('onclick', `desfavoritar(${id})`);
                button.innerHTML = '<img src="../images/excluir.png" alt="Desfavoritar" class="desfavorito">';
            }
        } else {
            alert('Erro ao favoritar: ' + data.erro);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
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

        const button = document.querySelector(`button[data-id='${id}']`);
        if (button) {
            button.className = 'button-favorito';
            button.setAttribute('onclick', `favoritar(${id})`);
            button.innerHTML = '<img src="../images/heart_icon.png" alt="Favoritar" class="icon-favorito">';
        }
    });
}
