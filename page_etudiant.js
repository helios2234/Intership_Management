document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("main section.window");
  const navLinks = document.querySelectorAll("nav a.nav-link");

  function afficherSection(id) {
    sections.forEach(section => {
      section.classList.toggle("active", section.id === id);
    });

    navLinks.forEach(link => {
      link.classList.toggle(
        "active",
        link.getAttribute("href").substring(1) === id
      );
    });
  }

  // Affiche la première section au départ (offres)
  afficherSection("offres");

  // Gestion clics sur les liens du menu
  navLinks.forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      const cible = link.getAttribute("href").substring(1);
      afficherSection(cible);
    });
  });

  // Gérer les formulaires

  // Fonction générique d'ajout d'item dans une liste
  function ajouterItem(form, listeId, formatFn) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const liste = document.getElementById(listeId);

      // Crée un objet avec les valeurs du formulaire
      const formData = new FormData(form);

      // Crée un <li> avec contenu formaté
      const li = document.createElement("li");
      li.innerHTML = formatFn(formData);

      liste.appendChild(li);

      form.reset();
    });
  }

  // Offres
  ajouterItem(document.getElementById("offres-form"), "liste-offres", (data) => {
    return `<strong>${data.get("titreOffre")}</strong> - ${data.get("descriptionOffre")} (Publié le ${data.get("dateOffre")})`;
  });

  // Candidatures
  ajouterItem(document.getElementById("candidatures-form"), "liste-candidatures", (data) => {
    return `<strong>${data.get("poste")}</strong> chez <em>${data.get("entreprise")}</em> - ${data.get("statut")} (Candidature du ${data.get("dateCandidature")})`;
  });

  // Rapports (avec gestion fichier PDF)
  document.getElementById("rapport-form").addEventListener("submit", (e) => {
    e.preventDefault();
    const form = e.target;
    const liste = document.getElementById("liste-rapports");

    const titre = form.titre.value;
    const description = form.description.value;
    const date = form.date.value;
    const fichierInput = form.fichier;
    let fichierLien = "";

    if (fichierInput.files.length > 0) {
      const fichier = fichierInput.files[0];
      fichierLien = `<a href="#" onclick="alert('La gestion réelle du fichier nécessite un backend');return false;">${fichier.name}</a>`;
    }

    const li = document.createElement("li");
    li.innerHTML = `<strong>${titre}</strong> - ${description} (Soumis le ${date}) ${fichierLien}`;
    liste.appendChild(li);

    form.reset();
  });

  // Contacter encadrant
  ajouterItem(document.getElementById("encadrant-form"), "liste-messages", (data) => {
    return `<strong>${data.get("objet")}</strong> - ${data.get("message")} (Envoyé le ${data.get("dateContact")})`;
  });

  // Évaluations
  ajouterItem(document.getElementById("evaluation-form"), "liste-evaluations", (data) => {
    return `<strong>${data.get("matiere")}</strong> : ${data.get("note")} / 20 (le ${data.get("dateEvaluation")})`;
  });
});





