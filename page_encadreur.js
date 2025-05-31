
document.addEventListener('DOMContentLoaded', () => {

  // Publier une offre
  const publierForm = document.getElementById('publier-form');
  const listeOffres = document.getElementById('liste-offres');

  publierForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const titre = publierForm.titreOffre.value.trim();
    const desc = publierForm.descriptionOffre.value.trim();
    const datePub = publierForm.datePublication.value;

    if (titre && desc && datePub) {
      const li = document.createElement('li');
      li.textContent = `${titre} - ${desc} (Publié le ${datePub})`;
      listeOffres.appendChild(li);

      publierForm.reset();
    }
  });

  // Gérer les candidatures
  const candidaturesForm = document.getElementById('candidatures-form');
  const listeCandidatures = document.getElementById('liste-candidatures');

  candidaturesForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const nom = candidaturesForm.nomEtudiant.value.trim();
    const poste = candidaturesForm.poste.value.trim();
    const dateCand = candidaturesForm.dateCandidature.value;
    const statut = candidaturesForm.statut.value;

    if (nom && poste && dateCand && statut) {
      const li = document.createElement('li');
      li.textContent = `${nom} - Poste: ${poste} - Candidature du ${dateCand} - Statut: ${statut}`;
      listeCandidatures.appendChild(li);

      candidaturesForm.reset();
    }
  });

  // Suivi des stagiaires
  const stagiairesForm = document.getElementById('stagiaires-form');
  const listeStagiaires = document.getElementById('liste-stagiaires');

  stagiairesForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const nom = stagiairesForm.nomStagiaire.value.trim();
    const periode = stagiairesForm.periode.value.trim();
    const commentaires = stagiairesForm.commentaires.value.trim();

    if (nom && periode) {
      const li = document.createElement('li');
      li.innerHTML = `<strong>${nom}</strong> - ${periode} <br/> Commentaires : ${commentaires}`;
      listeStagiaires.appendChild(li);

      stagiairesForm.reset();
    }
  });

  // Évaluer les étudiants
  const evaluationsForm = document.getElementById('evaluations-form');
  const listeEvaluations = document.getElementById('liste-evaluations');

  evaluationsForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const nom = evaluationsForm.nomEtudiantEval.value.trim();
    const matiere = evaluationsForm.matiereEval.value.trim();
    const note = evaluationsForm.noteEval.value;
    const date = evaluationsForm.dateEval.value;

    if (nom && matiere && note && date) {
      const li = document.createElement('li');
      li.textContent = `${nom} - ${matiere} - Note: ${note}/20 - Date: ${date}`;
      listeEvaluations.appendChild(li);

      evaluationsForm.reset();
    }
  });

  // Gérer profil
  const profilForm = document.getElementById('profil-form');
  const listeProfil = document.getElementById('liste-profil');

  profilForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const nom = profilForm.nomEntreprise.value.trim();
    const adresse = profilForm.adresse.value.trim();
    const contact = profilForm.contact.value.trim();

    if (nom && adresse && contact) {
      listeProfil.innerHTML = `
        <li><strong>Nom :</strong> ${nom}</li>
        <li><strong>Adresse :</strong> ${adresse}</li>
        <li><strong>Contact :</strong> ${contact}</li>
      `;

      profilForm.reset();
    }
  });

  // Optionnel : gestion active des liens de navigation
  const navLinks = document.querySelectorAll('nav ul li a');
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      navLinks.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    });
  });

});
