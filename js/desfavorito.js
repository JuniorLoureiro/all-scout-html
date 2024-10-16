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
        // Remove o item correspondente da interface
        document.getElementById('atleta-' + id).style.display = 'none';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocorreu um erro ao desfavoritar o atleta.');
    });
}
