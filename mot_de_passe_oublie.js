document.getElementById("resetForm").addEventListener("submit", function(e) {
  const email = document.getElementById("email").value;
  if (!email) {
    alert("Veuillez entrer votre adresse email.");
    e.preventDefault();
  } else {
    alert("Un lien de réinitialisation sera envoyé si l'adresse existe dans notre base de données.");
  }
});
