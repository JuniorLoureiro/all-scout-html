console.log("searchGeral.js carregado com sucesso");

const searchGeralInput = document.getElementById('searchGeral-input');
const searchGeralResults = document.getElementById('searchGeral-results');

// Simulação de dados de exemplo
const data = [
    'Agustín Marchesín',
    'Pedro Geromel',
    'Alexander Aravena',
    'Walter Kannemann',
    'Franco Cristaldo',
    'Rodrigo Ely',
    'Reinaldo',
    'João Pedro',
    'Diego Costa',
    'Fábio'
];

// Filtra os resultados conforme o usuário digita
searchGeralInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    searchGeralResults.innerHTML = ''; // Limpa os resultados anteriores

    if (query) {
        const filteredResults = data.filter(item => item.toLowerCase().includes(query));
        if (filteredResults.length) {
            filteredResults.forEach(item => {
                const resultItem = document.createElement('div');
                resultItem.textContent = item;
                resultItem.addEventListener('click', () => {
                    searchGeralInput.value = item; // Preenche o campo de busca com o item selecionado
                    searchGeralResults.style.display = 'none'; // Oculta os resultados
                });
                searchGeralResults.appendChild(resultItem);
            });
            searchGeralResults.style.display = 'block';
        } else {
            searchGeralResults.style.display = 'none';
        }
    } else {
        searchGeralResults.style.display = 'none';
    }
});

// Oculta os resultados ao clicar fora do campo de busca
document.addEventListener('click', function(event) {
    if (!searchGeralInput.contains(event.target) && !searchGeralResults.contains(event.target)) {
        searchGeralResults.style.display = 'none';
    }
});
