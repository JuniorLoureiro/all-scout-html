$(document).ready(function() {
    // Formatar CPF
    $('#cpf').on('input', function() {
        let cpf = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cpf.length > 11) {
            cpf = cpf.slice(0, 11); // Limita o CPF a 11 dígitos
        }
        $(this).val(cpf.replace(/(\d{3})(\d)/, "$1.$2")
                       .replace(/(\d{3})(\d)/, "$1.$2")
                       .replace(/(\d{3})(\d{1,2})$/, "$1-$2"));
    });

    // Formatar Celular
    $('#celular').on('input', function() {
        let celular = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (celular.length > 11) {
            celular = celular.slice(0, 11); // Limita o celular a 11 dígitos
        }
        if (celular.length > 6) {
            $(this).val(`(${celular.slice(0, 2)}) ${celular.slice(2, 7)}-${celular.slice(7)}`);
        } else if (celular.length > 2) {
            $(this).val(`(${celular.slice(0, 2)}) ${celular.slice(2)}`);
        } else {
            $(this).val(celular);
        }
    });
});