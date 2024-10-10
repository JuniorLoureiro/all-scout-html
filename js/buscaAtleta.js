function removeAcentos(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}
function filterAtletas() {
    // Obtém o valor da barra de pesquisa
    const input = document.getElementById('searchInput');
    const filter = removeAcentos(input.value).toLowerCase(); // Remove acentos da entrada do usuário e deixa minusculo
    const buttons = document.querySelectorAll('.button-atleta'); // Seleciona todos os botões dos atletas

    // Itera sobre os botões e os mostra ou oculta com base no filtro
    buttons.forEach(button => {
        const title = removeAcentos(button.querySelector('.button-title-atleta').textContent).toLowerCase();
        const club = removeAcentos(button.querySelector('.button-club-atleta').textContent).toLowerCase();
        if (title.includes(filter) || club.includes(filter)) {
            button.style.display = ''; // Mostra o botão
        } 
        else {
            button.style.display = 'none'; // Oculta o botão
        }
    });

   

   
}