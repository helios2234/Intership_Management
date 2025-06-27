// file : page_etudiant.js

// dynamic Navigation 
const navLinks = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll(".window");

navLinks.forEach(link => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const targetId = this.getAttribute("href").substring(1);

    sections.forEach(section => {
      if (section.id === targetId) {
        section.style.display = "block";
        section.classList.add("animate__animated", "animate__fadeInRight");
      } else {
        section.style.display = "none";
        section.classList.remove("animate__animated", "animate__fadeInRight");
      }
    });
  });
});

// show first section by default
sections.forEach((section, index) => {
  section.style.display = index === 0 ? "block" : "none";
});











