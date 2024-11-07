function scrollCarouselRight(carouselId) {
    const container = document.querySelector(`${carouselId} .container-cards`);
    console.log('Movendo para a direita automaticamente'); // Mensagem de teste
    if (container) {
        container.scrollBy({ left: 330, behavior: 'smooth' });
    }
}

function scrollCarouselLeft(carouselId) {
    const container = document.querySelector(`${carouselId} .container-cards`);
    console.log('Botão da esquerda clicado!'); // Mensagem de teste
    if (container) {
        container.scrollBy({ left: -330, behavior: 'smooth' });
    }
}


/*
function startAutoScroll(carouselId) {
    setInterval(() => {
        scrollCarouselRight(carouselId);
    }, 4000); // 4 segundos
}

// Inicia o auto-scroll no carregamento da página
document.addEventListener('DOMContentLoaded', () => {
    startAutoScroll('#card-carousel');
});

*/