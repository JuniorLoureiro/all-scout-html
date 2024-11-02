// Função para remover acentos de uma string
function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Remove acentos
}

function filterAtletas() {
    // Obtenha o valor dos dois campos de pesquisa (header e aside)
    const inputHeader = document.getElementById('searchGeral-input');
    const inputAside = document.getElementById('searchInput');

    // Combine os valores dos dois campos, priorizando o campo preenchido
    const filter = removeAccents((inputHeader.value || inputAside.value).toLowerCase());

    const atletaItems = document.querySelectorAll('.atleta-item');
    const searchResults = document.getElementById('searchGeral-results');
    searchResults.innerHTML = ""; // Limpar resultados anteriores

    let hasResults = false; // Verificar se há algum resultado

    atletaItems.forEach(atleta => {
        // Remove acentos e transforma em lowercase para busca nos textos do título e da informação
        const title = removeAccents(atleta.querySelector('.button-title-atleta').textContent.toLowerCase());
        const info = removeAccents(atleta.querySelector('.button-info-atleta').textContent.toLowerCase());

        if (title.includes(filter) || info.includes(filter)) {
            atleta.style.display = ''; // Exibe o botão correspondente

            // Criar um item de resultado clicável na barra de pesquisa do header
            const resultItem = document.createElement('div');
            resultItem.classList.add('search-result-item');
            resultItem.textContent = atleta.querySelector('.button-title-atleta').textContent;

            // Tornar o resultado clicável para direcionar ao atleta
            resultItem.addEventListener('click', () => {
                atleta.scrollIntoView({ behavior: 'smooth' });
                atleta.querySelector('a').click();
            });

            searchResults.appendChild(resultItem);
            hasResults = true;
        } else {
            atleta.style.display = 'none'; // Oculta o botão que não corresponde
        }
    });

    // Exibir ou ocultar a lista de resultados no header com base na presença de resultados
    searchResults.style.display = hasResults ? 'block' : 'none';
}

// Adicione os eventos onkeyup para os campos de pesquisa do header e aside
document.getElementById('searchGeral-input').addEventListener('keyup', filterAtletas);
document.getElementById('searchInput').addEventListener('keyup', filterAtletas);
