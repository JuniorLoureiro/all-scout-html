function removeAcentos(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

function filterClubes() {
    const input = document.getElementById('searchGeral-input');
    const filter = removeAcentos(input.value).toLowerCase();
    console.log("Filtro aplicado: ", filter);

    const buttons = document.querySelectorAll('.button-clube');
    const resultsContainer = document.getElementById('searchGeral-results');

    // Limpa resultados anteriores
    resultsContainer.innerHTML = '';

    buttons.forEach(button => {
        const titleElement = button.querySelector('.button-title-clube');
        const clubId = button.getAttribute('href').split('=')[1]; // Extraindo o ID do clube do link
        if (titleElement) {
            const title = removeAcentos(titleElement.textContent).toLowerCase();
            console.log("Comparando com: ", title);
            if (title.includes(filter)) {
                // Cria um novo elemento de resultado
                const resultItem = document.createElement('div');
                resultItem.className = 'result-item'; // Classe para estilização
                resultItem.textContent = title; // Nome do clube como texto

                // Adiciona evento de clique para redirecionar
                resultItem.onclick = function() {
                    window.location.href = 'exibeClube.php?id=' + clubId; // Redireciona para a página do clube
                };

                resultsContainer.appendChild(resultItem); // Adiciona o texto ao contêiner de resultados
            }
        }
    });

    // Exibe ou oculta o contêiner de resultados com base nos resultados encontrados
    resultsContainer.style.display = resultsContainer.children.length > 0 ? 'block' : 'none';
}

// Adiciona evento de input para ambas as barras de pesquisa
document.getElementById('searchClube').addEventListener('input', filterClubes);
document.getElementById('searchGeral-input').addEventListener('input', filterClubes);
