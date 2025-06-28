document.addEventListener("DOMContentLoaded", () => {
  const inputs = document.querySelectorAll("input, select");
  inputs.forEach(input => {
    input.addEventListener("focus", () => {
      input.style.backgroundColor = "#e6f0ff";
    });
    input.addEventListener("blur", () => {
      input.style.backgroundColor = "";
    });
  });

  const form = document.getElementById("loginForm");
  form.addEventListener("submit", e => {
    e.preventDefault(); // Pour empêcher la soumission du formulaire
    const button = form.querySelector("button");
    button.textContent = "Connexion...";
    button.disabled = true;
    button.style.opacity = "0.6";

    const userType = document.getElementById("user_type").value;
    if (userType == "etudiant") {
      window.location.href = "page_etudiants.html";
    } else if (userType == "entreprise") {
      window.location.href = "page_entreprises.html";
    } else if (userType == "encadreur") {
      window.location.href = "page_encadreurs.html";
    } else {
      alert("Veuillez sélectionner un type d'utilisateur");
      button.textContent = "Connexion";
      button.disabled = false;
      button.style.opacity = "1";
    }
  });
});
