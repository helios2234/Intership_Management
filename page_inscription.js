// light animation on inputs
document.querySelectorAll('input, select, textarea').forEach(element => {
    element.addEventListener('focus', () => {
        element.style.boxShadow = '0 0 10px rgba(0,123,255,0.4)';
    });
    element.addEventListener('blur', () => {
        element.style.boxShadow = 'none';
    });
});

// Animation when button is clicked
document.querySelector('.btn').addEventListener('click', (e) => {
    e.target.classList.add('clicked');
    setTimeout(() => e.target.classList.remove('clicked'), 150);
});

