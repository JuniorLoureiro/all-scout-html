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



function filterResultados() {
    const input = document.getElementById('searchGeral-input');
    const filter = removeAcentos(input.value).toLowerCase();
    console.log("Filtro aplicado: ", filter);

    const buttonsClubes = document.querySelectorAll('.button-clube');
    const atletaItems = document.querySelectorAll('.atleta-item');
    const resultsContainer = document.getElementById('searchGeral-results');

    // Limpa resultados anteriores
    resultsContainer.innerHTML = '';

    let hasResults = false; // Verifica se há resultados

    // Busca clubes
    buttonsClubes.forEach(button => {
        const titleElement = button.querySelector('.button-title-clube');
        const clubId = button.getAttribute('href').split('=')[1]; // Extrai o ID do clube do link

        if (titleElement) {
            const title = removeAcentos(titleElement.textContent).toLowerCase();
            console.log("Comparando com: ", title);
            if (title.includes(filter)) {
                const resultItem = document.createElement('div');
                resultItem.className = 'result-item'; // Classe para estilização
                resultItem.textContent = title.toUpperCase(); // Nome do clube em maiúsculas

                // Adiciona evento de clique para redirecionar
                resultItem.onclick = function() {
                    window.location.href = 'exibeClube.php?id=' + clubId; // Redireciona para a página do clube
                };

                resultsContainer.appendChild(resultItem); // Adiciona o texto ao contêiner de resultados
                hasResults = true;
            }
        }
    });

    // Busca atletas
    atletaItems.forEach(atleta => {
        const title = removeAcentos(atleta.querySelector('.button-title-atleta').textContent.toLowerCase());
        const info = removeAcentos(atleta.querySelector('.button-info-atleta').textContent.toLowerCase());

        if (title.includes(filter) || info.includes(filter)) {
            atleta.style.display = ''; // Exibe o botão correspondente

            const resultItem = document.createElement('div');
            resultItem.classList.add('result-item'); // Estilização
            resultItem.textContent = atleta.querySelector('.button-title-atleta').textContent.toUpperCase(); // Nome do atleta em maiúsculas

            // Tornar o resultado clicável para direcionar ao atleta
            resultItem.addEventListener('click', () => {
                atleta.scrollIntoView({ behavior: 'smooth' });
                atleta.querySelector('a').click(); // Simula o clique no link do atleta
            });

            resultsContainer.appendChild(resultItem); // Adiciona o resultado ao contêiner
            hasResults = true;
        } else {
            atleta.style.display = 'none'; // Oculta o botão que não corresponde
        }
    });

    // Exibe ou oculta o contêiner de resultados com base nos resultados encontrados
    resultsContainer.style.display = hasResults ? 'block' : 'none';
}

// Adiciona evento de input para a barra de pesquisa
document.getElementById('searchGeral-input').addEventListener('keyup', filterResultados);

