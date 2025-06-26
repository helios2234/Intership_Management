// Script simple pour gérer la mise en place des animations et effets si besoin

document.addEventListener("DOMContentLoaded", () => {
  // Ici on pourrait ajouter des effets ou interactions supplémentaires
  // Exemple : focus automatique sur la section "about"
  const aboutSection = document.getElementById('about');
  if (aboutSection) {
    aboutSection.focus();
  }

  // Optionnel : scroll smooth is enabled via CSS scroll-behavior
});
// Quand la page est complètement chargée
window.addEventListener('load', () => {
  const citationSection = document.getElementById('citation');
  if (citationSection) {
    // Scroll smooth vers la section citation
    citationSection.scrollIntoView({ behavior: 'smooth' });
  }
});
