$(document).ready(function() {
    $('#cep').on('input', function() {
        let cep = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cep.length > 8) {
            cep = cep.slice(0, 8); // Limita o CEP a 8 dígitos
        }
        $(this).val(cep.replace(/^(\d{2})(\d{3})(\d{3})$/, "$1.$2-$3"));
    });

    $('#cep').on('blur', function() {
        var cep = $('#cep').val().replace(/\D/g, ''); // Remove caracteres não numéricos

        if (cep.length === 8) { // Verifica se o CEP tem 8 dígitos
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!data.erro) { // Se não houve erro na busca
                    $('#logradouro').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                }
            });
        } else {
            alert('Por favor, insira um CEP válido.');
        }
    });
});