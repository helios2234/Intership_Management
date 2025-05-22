document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  form.addEventListener("submit", (e) => {
    const button = form.querySelector("button");
    button.innerText = "Connexion en cours...";
    button.disabled = true;
    button.style.opacity = 0.7;
  });

  const inputs = document.querySelectorAll("input, select");
  inputs.forEach(input => {
    input.addEventListener("focus", () => {
      input.style.boxShadow = "0 0 8px #2575fc44";
    });
    input.addEventListener("blur", () => {
      input.style.boxShadow = "none";
    });
  });
});
