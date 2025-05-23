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
    const button = form.querySelector("button");
    button.textContent = "Connexion...";
    button.disabled = true;
    button.style.opacity = "0.6";
  });
});

