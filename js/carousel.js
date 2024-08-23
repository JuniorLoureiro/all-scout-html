// Script para ativar o Carrossel
let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-slide');
const totalSlides = slides.length;

function showSlide(index) {
    // Impede o índice de ultrapassar o número de slides
    index = (index + totalSlides) % totalSlides;
    slides.forEach((slide, i) => {
        slide.style.transform = `translateX(${(i - index) * 100}%)`;
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(currentSlide);
}

// Adiciona eventos de clique aos botões
document.querySelector('.carousel-next').addEventListener('click', nextSlide);
document.querySelector('.carousel-prev').addEventListener('click', prevSlide);

// Inicia o carrossel
setInterval(nextSlide, 5000); // Altera o slide a cada 5 segundos
showSlide(currentSlide); // Inicializa o primeiro slide