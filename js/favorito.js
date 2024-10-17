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


