document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("main section.window");
  const navLinks = document.querySelectorAll("nav a.nav-link");

  function afficherSection(id) {
    sections.forEach(section => {
      section.classList.toggle("active", section.id === id);
    });
    navLinks.forEach(link => {
      link.classList.toggle("active", link.getAttribute("href").substring(1) === id);
    });
  }

  afficherSection("etudiants");

  navLinks.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      afficherSection(link.getAttribute("href").substring(1));
    });
  });

  function ajouterItem(form, listeId, formatFn) {
    form.addEventListener("submit", e => {
      e.preventDefault();
      const liste = document.getElementById(listeId);
      const data = new FormData(form);
      const li = document.createElement("li");
      li.innerHTML = formatFn(data);
      liste.appendChild(li);
      form.reset();
    });
  }

  ajouterItem(document.getElementById("etudiants-form"), "liste-etudiants", data =>
    `<strong>${data.get("nomEtudiant")}</strong> - Filière : ${data.get("filiere")} - Niveau : ${data.get("niveau")}`
  );

  ajouterItem(document.getElementById("rapports-form"), "liste-rapports", data =>
    `<strong>${data.get("nomRapport")}</strong> - "${data.get("titreRapport")}" - Validation : ${data.get("validation")}`
  );

  ajouterItem(document.getElementById("commentaires-form"), "liste-commentaires", data =>
    `<strong>${data.get("nomEtudiantCom")}</strong> : ${data.get("commentaire")}`
  );

  ajouterItem(document.getElementById("planning-form"), "liste-planning", data =>
    `${data.get("datePlanning")} - ${data.get("activite")}`
  );

  ajouterItem(document.getElementById("feedbacks-form"), "liste-feedbacks", data =>
    `<strong>${data.get("nomEtudiantFeed")}</strong> : ${data.get("feedback")}`
  );
});
