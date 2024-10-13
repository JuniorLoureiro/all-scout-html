function removeAcentos(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

function filterClubes() {
    const input = document.getElementById('searchClube');
    const filter = removeAcentos(input.value).toLowerCase();
    console.log("Filtro aplicado: ", filter);
    const buttons = document.querySelectorAll('.button-clube');

    buttons.forEach(button => {
        const titleElement = button.querySelector('.button-title-clube');
        if (titleElement) {
            const title = removeAcentos(titleElement.textContent).toLowerCase();
            console.log("Comparando com: ", title);
            if (title.includes(filter)) {
                button.style.display = ''; // Mostra o botão
            } else {
                button.style.display = 'none'; // Oculta o botão
            }
        }
    });
}