// Função para remover acentos de uma string
function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

// Função para filtrar atletas na barra de pesquisa do aside
function filterAtletasAside() {
    const inputAside = document.getElementById('searchInput');
    const filter = removeAccents(inputAside.value.toLowerCase());
    const atletaItems = document.querySelectorAll('.atleta-item');

    atletaItems.forEach(atleta => {
        const title = removeAccents(atleta.querySelector('.button-title-atleta').textContent.toLowerCase());
        const info = removeAccents(atleta.querySelector('.button-info-atleta').textContent.toLowerCase());

        atleta.style.display = title.includes(filter) || info.includes(filter) ? '' : 'none';
    });
}

// Função para filtrar resultados de atletas e clubes na barra de pesquisa do header
function filterResultadosHeader() {
    const inputHeader = document.getElementById('searchGeral-input');
    const filter = removeAccents(inputHeader.value.toLowerCase());
    const atletaItems = document.querySelectorAll('.atleta-item');
    const resultsContainer = document.getElementById('searchGeral-results');

    resultsContainer.innerHTML = '';
    let hasResults = false;

    atletaItems.forEach(atleta => {
        const title = removeAccents(atleta.querySelector('.button-title-atleta').textContent.toLowerCase());

        if (title.includes(filter)) {
            const resultItem = document.createElement('div');
            resultItem.classList.add('search-result-item');
            resultItem.textContent = atleta.querySelector('.button-title-atleta').textContent;

            resultItem.addEventListener('click', () => {
                atleta.scrollIntoView({ behavior: 'smooth' });
                atleta.querySelector('a').click();
            });

            resultsContainer.appendChild(resultItem);
            hasResults = true;
        }
    });

    resultsContainer.style.display = hasResults ? 'block' : 'none';
}

// 🧠 Espera o DOM estar carregado antes de buscar os inputs
document.addEventListener('DOMContentLoaded', function () {
    const searchHeader = document.getElementById('searchGeral-input');
    const searchAside = document.getElementById('searchInput');

    if (searchHeader) {
        searchHeader.addEventListener('keyup', filterResultadosHeader);
    }

    if (searchAside) {
        searchAside.addEventListener('keyup', filterAtletasAside);
    }
});
