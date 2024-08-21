// Script para ativar a acessibilidade de fonte
document.addEventListener('DOMContentLoaded', function() {
    const decreaseFontButton = document.getElementById('decrease-font');
    const increaseFontButton = document.getElementById('increase-font');
    let currentFontSize = 16; // Tamanho de fonte inicial em pixels

    decreaseFontButton.addEventListener('click', function() {
        currentFontSize = Math.max(12, currentFontSize - 2); // Define um tamanho mínimo
        document.body.style.fontSize = `${currentFontSize}px`;
    });

    increaseFontButton.addEventListener('click', function() {
        currentFontSize = Math.min(24, currentFontSize + 2); // Define um tamanho máximo
        document.body.style.fontSize = `${currentFontSize}px`;
    });
});
