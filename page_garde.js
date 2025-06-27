// script to manage the implementation of effects and animations if needed

document.addEventListener("DOMContentLoaded", () => {
  // here we can add additional effects
  // Example : focus on the "about" section
  const aboutSection = document.getElementById('about');
  if (aboutSection) {
    aboutSection.focus();
  }

  // Optional : smooth scroll is enabled via CSS scroll-behavior
});
// for a fully loaded page
window.addEventListener('load', () => {
  const citationSection = document.getElementById('citation');
  if (citationSection) {
    // smooth scroll
    citationSection.scrollIntoView({ behavior: 'smooth' });
  }
});
