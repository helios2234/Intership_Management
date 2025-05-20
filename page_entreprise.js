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

  afficherSection("publier");

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

  ajouterItem(document.getElementById("publier-form"), "liste-offres", data =>
    `<strong>${data.get("titreOffre")}</strong> - ${data.get("descriptionOffre")} (Publié le ${data.get("datePublication")})`
  );

  ajouterItem(document.getElementById("candidatures-form"), "liste-candidatures", data =>
    `<strong>${data.get("nomEtudiant")}</strong> - ${data.get("poste")} (Candidature du ${data.get("dateCandidature")}) - Statut : ${data.get("statut")}`
  );

  ajouterItem(document.getElementById("stagiaires-form"), "liste-stagiaires", data =>
    `<strong>${data.get("nomStagiaire")}</strong> - Période : ${data.get("periode")}<br>${data.get("commentaires") ? `Commentaires: ${data.get("commentaires")}` : ""}`
  );

  ajouterItem(document.getElementById("evaluations-form"), "liste-evaluations", data =>
    `<strong>${data.get("nomEtudiantEval")}</strong> - ${data.get("matiereEval")}: ${data.get("noteEval")} / 20 (le ${data.get("dateEval")})`
  );

  ajouterItem(document.getElementById("profil-form"), "liste-profil", data =>
    `<strong>${data.get("nomEntreprise")}</strong><br>Adresse : ${data.get("adresse")}<br>Contact : ${data.get("contact")}`
  );
});
