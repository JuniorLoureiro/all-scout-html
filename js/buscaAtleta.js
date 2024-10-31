function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Remove acentos
}

function filterAtletas() {
    const input = document.getElementById('searchInput');
    const filter = removeAccents(input.value.toLowerCase()); // Remove acentos da entrada
    const atletaItems = document.querySelectorAll('.atleta-item');

    atletaItems.forEach(atleta => {
        const title = removeAccents(atleta.querySelector('.button-title-atleta').textContent.toLowerCase()); // Remove acentos do título
        const info = removeAccents(atleta.querySelector('.button-info-atleta').textContent.toLowerCase()); // Remove acentos da informação
        
        if (title.includes(filter) || info.includes(filter)) {
            atleta.style.display = ''; // Exibe o botão correspondente
        } else {
            atleta.style.display = 'none'; // Oculta o botão que não corresponde
        }
    });
}