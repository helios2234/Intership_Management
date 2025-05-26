// Animation d'apparition au scroll
function reveal() {
    const reveals = document.querySelectorAll('.reveal');

    reveals.forEach(section => {
        const windowHeight = window.innerHeight;
        const elementTop = section.getBoundingClientRect().top;
        const visiblePoint = 100;

        if (elementTop < windowHeight - visiblePoint) {
            section.classList.add('visible');
        }
    });
}

window.addEventListener('scroll', reveal);
window.addEventListener('load', reveal);
