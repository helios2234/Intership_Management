document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute('href'));
    target.scrollIntoView({ behavior: 'smooth' });
  });
});

// Offres
document.getElementById('publier-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const titre = document.getElementById('titreOffre').value;
  const desc = document.getElementById('descriptionOffre').value;
  const date = document.getElementById('datePublication').value;

  const li = document.createElement('li');
  li.textContent = `${titre} - ${desc} (${date})`;
  document.getElementById('liste-offres').appendChild(li);
  this.reset();
});

// Candidature
document.getElementById('candidatures-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const nom = document.getElementById('nomEtudiant').value;
  const poste = document.getElementById('poste').value;
  const date = document.getElementById('dateCandidature').value;
  const statut = document.getElementById('statut').value;

  const li = document.createElement('li');
  li.textContent = `${nom} - ${poste} - ${statut} (${date})`;
  document.getElementById('liste-candidatures').appendChild(li);
  this.reset();
});

// Stagiaire
document.getElementById('stagiaires-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const nom = document.getElementById('nomStagiaire').value;
  const periode = document.getElementById('periode').value;
  const comm = document.getElementById('commentaires').value;

  const li = document.createElement('li');
  li.textContent = `${nom} - ${periode} | ${comm}`;
  document.getElementById('liste-stagiaires').appendChild(li);
  this.reset();
});

// Évaluations
document.getElementById('evaluations-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const nom = document.getElementById('nomEtudiantEval').value;
  const matiere = document.getElementById('matiereEval').value;
  const note = document.getElementById('noteEval').value;
  const date = document.getElementById('dateEval').value;

  const li = document.createElement('li');
  li.textContent = `${nom} - ${matiere} : ${note}/20 (${date})`;
  document.getElementById('liste-evaluations').appendChild(li);
  this.reset();
});

// Profil
document.getElementById('profil-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const nom = document.getElementById('nomEntreprise').value;
  const adresse = document.getElementById('adresse').value;
  const contact = document.getElementById('contact').value;

  const li = document.createElement('li');
  li.textContent = `Nom: ${nom} | Adresse: ${adresse} | Contact: ${contact}`;
  document.getElementById('liste-profil').innerHTML = ''; // remplacer
  document.getElementById('liste-profil').appendChild(li);
  this.reset();
});
