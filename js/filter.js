function filterGeral() {
    const input = document.getElementById('searchGeral-input');
    const filter = removeAcentos(input.value.toLowerCase());
    const atletaItems = document.querySelectorAll('.atleta-item');
    const clubeItems = document.querySelectorAll('.button-clube');
    const searchResults = document.getElementById('searchGeral-results');
    searchResults.innerHTML = ""; // Limpar resultados anteriores

    let hasResults = false;

    // Busca e exibe os clubes correspondentes
    clubeItems.forEach(clube => {
        const titleElement = clube.querySelector('.button-title-clube');
        if (titleElement) {
            const title = removeAcentos(titleElement.textContent.toLowerCase());

            if (title.includes(filter)) {
                clube.style.display = ''; // Mostra o botão do clube

                // Cria um item de resultado clicável para o clube
                const resultItem = document.createElement('div');
                resultItem.classList.add('search-result-item');
                resultItem.textContent = titleElement.textContent;
                resultItem.addEventListener('click', () => {
                    clube.scrollIntoView({ behavior: 'smooth' });
                    clube.querySelector('a').click();
                });

                searchResults.appendChild(resultItem);
                hasResults = true;
            } else {
                clube.style.display = 'none';
            }
        }
    });

    // Busca e exibe os atletas correspondentes
    atletaItems.forEach(atleta => {
        const title = removeAcentos(atleta.querySelector('.button-title-atleta').textContent.toLowerCase());
        const info = removeAcentos(atleta.querySelector('.button-info-atleta').textContent.toLowerCase());

        if (title.includes(filter) || info.includes(filter)) {
            atleta.style.display = ''; // Exibe o botão do atleta

            // Cria um item de resultado clicável para o atleta
            const resultItem = document.createElement('div');
            resultItem.classList.add('search-result-item');
            resultItem.textContent = atleta.querySelector('.button-title-atleta').textContent;
            resultItem.addEventListener('click', () => {
                atleta.scrollIntoView({ behavior: 'smooth' });
                atleta.querySelector('a').click();
            });

            searchResults.appendChild(resultItem);
            hasResults = true;
        } else {
            atleta.style.display = 'none';
        }
    });

    // Exibir ou ocultar a lista de resultados no header
    searchResults.style.display = hasResults ? 'block' : 'none';
}

// Vincula a função filterGeral ao evento onkeyup do campo searchGeral-input
document.getElementById('searchGeral-input').addEventListener('keyup', filterGeral);
