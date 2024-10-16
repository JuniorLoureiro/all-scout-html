document.addEventListener('DOMContentLoaded', function() {
    // Função para tratar o envio dos formulários de favoritos
    const handleFavoriteFormSubmit = (event) => {
        event.preventDefault(); // Impede o envio tradicional do formulário
        const formData = new FormData(event.target); // Obtém os dados do formulário

        // Verifica a ação a ser realizada (favoritar ou desfavoritar)
        const action = event.target.classList.contains('favoritar-form') ? 'atletas.php' : 'desfavoritar.php';

        // Envia os dados via fetch (AJAX)
        fetch(action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            if (data.success) {
                alert(data.message);
                if (event.target.classList.contains('desfavoritar-form')) {
                    // Remove o item da interface se for desfavoritar
                    const atletaId = formData.get('id_atleta'); // Obtém o ID do atleta
                    const atletaItem = document.getElementById('atleta-' + atletaId);
                    if (atletaItem) {
                        atletaItem.remove(); // Remove o elemento do DOM
                    }
                } else {
                    // Aqui você pode atualizar a interface conforme necessário (ex: trocar o botão para desfavoritar)
                    // Adicionar lógica para atualizar o botão se necessário
                }
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    };

    // Adiciona eventos para todos os formulários de favoritos
    const favoritarForms = document.querySelectorAll('.favoritos-form, .desfavoritar-form');
    favoritarForms.forEach(form => {
        form.addEventListener('submit', handleFavoriteFormSubmit);
    });
});
