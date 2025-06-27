document.getElementById("resetForm").addEventListener("submit", function(e) {
  const email = document.getElementById("email").value;
  if (!email) {
    alert("please enter your email.");
    e.preventDefault();
  } else {
    alert("A reset link will be sent.");
  }
});
