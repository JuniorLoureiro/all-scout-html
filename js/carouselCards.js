function scrollCarouselRight(carouselId) {
    const container = document.querySelector(`${carouselId} .container-cards`);
    console.log('Botão da direita clicado!'); // Mensagem de teste
    if (container) {
        container.scrollBy({ left: 200, behavior: 'smooth' });
    }
}

function scrollCarouselLeft(carouselId) {
    const container = document.querySelector(`${carouselId} .container-cards`);
    console.log('Botão da esquerda clicado!'); // Mensagem de teste
    if (container) {
        container.scrollBy({ left: -200, behavior: 'smooth' });
    }
}