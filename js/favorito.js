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
        
        // Seleciona o botão de favoritar pelo data-id do atleta
        const button = document.querySelector(`button[data-id='${id}']`);
        if (button) {
            // Troca o conteúdo do botão para desfavoritar
            button.className = 'desfavoritar-button';
            button.setAttribute('onclick', `desfavoritar(${id})`);
            button.innerHTML = '<img src="../images/excluir.png" alt="Desfavoritar" class="desfavorito">';
        }
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

        // Seleciona o botão de favoritar pelo data-id do atleta     
        const button = document.querySelector(`button[data-id='${id}']`);
        if (button) {
       
            button.className = 'button-favorito';
            button.setAttribute('onclick', `favoritar(${id})`);
            button.innerHTML = '<img src="../images/heart_icon.png" alt="Favoritar" class="icon-favorito">';
        }
    });
    
}

