let nextSlideInterval;

function nextSlide() {
    var currentSlide = document.querySelector('input[name="slider"]:checked');
    var nextSlide = currentSlide.nextElementSibling || document.querySelector('input[name="slider"]:first-child');

    if (!nextSlide) {
        // Se non c'è una slide successiva, ritorna alla prima slide
        document.querySelector('input[name="slider"]:first-child').checked = true;
    } else {
        // Altrimenti, passa alla prossima slide
        nextSlide.checked = true;
    }
}

function prevSlide() {
    // Vai sempre alla prima slide
    document.querySelector('input[name="slider"]:first-child').checked = true;
    
    // Azzera il timer di nextSlide
    clearInterval(nextSlideInterval);

    // Riparti il timer di nextSlide
    nextSlideInterval = setInterval(nextSlide, 4000);
}

nextSlideInterval = setInterval(nextSlide, 4000); // Cambia slide ogni 4 secondi (4000 millisecondi)
setInterval(prevSlide, 14000); // Cambia slide ogni 14 secondi (14000 millisecondi)
