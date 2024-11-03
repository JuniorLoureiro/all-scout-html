function removeAcentos(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

// Função para a barra de pesquisa geral (header)
function filterGeral() {
    const input = document.getElementById('searchGeral-input');
    const filter = removeAcentos(input.value).toLowerCase();
    const resultsContainer = document.getElementById('searchGeral-results');

    resultsContainer.innerHTML = ''; // Limpa resultados anteriores

    document.querySelectorAll('.button-clube').forEach(button => {
        const title = removeAcentos(button.querySelector('.button-title-clube').textContent).toLowerCase();
        if (title.includes(filter)) {
            const resultItem = document.createElement('div');
            resultItem.className = 'result-item';
            resultItem.textContent = title;
            resultItem.onclick = () => {
                window.location.href = button.getAttribute('href');
            };
            resultsContainer.appendChild(resultItem);
        }
    });

    resultsContainer.style.display = resultsContainer.children.length > 0 ? 'block' : 'none';
}

// Função para a barra de pesquisa específica de clubes (aside)
function filterClubes() {
    const input = document.getElementById('searchClube');
    const filter = removeAcentos(input.value).toLowerCase();

    const buttonsContainer = document.querySelector('.clubes-buttons');
    const allButtons = buttonsContainer.querySelectorAll('.button-clube');

    // Oculta todos os botões inicialmente
    allButtons.forEach(button => button.style.display = 'none');

    // Mostra apenas os clubes que correspondem ao filtro
    allButtons.forEach(button => {
        const title = removeAcentos(button.querySelector('.button-title-clube').textContent).toLowerCase();
        if (title.includes(filter)) {
            button.style.display = 'block'; // Exibe o botão que corresponde ao filtro
        }
    });
}

// Adiciona o evento de input para ativar a pesquisa enquanto digita
document.getElementById('searchClube').addEventListener('input', filterClubes);
// Eventos independentes para cada barra de pesquisa
document.getElementById('searchGeral-input').addEventListener('input', filterGeral);

