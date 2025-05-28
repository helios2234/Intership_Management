document.addEventListener("DOMContentLoaded", () => {

  const aboutSection = document.getElementById('about');
  if (aboutSection) {
    aboutSection.focus();
  }

});
// Quand la page est complètement chargée
window.addEventListener('load', () => {
  const citationSection = document.getElementById('citation');
  if (citationSection) {
    // Scroll smooth vers la section citation
    citationSection.scrollIntoView({ behavior: 'smooth' });
  }
});
