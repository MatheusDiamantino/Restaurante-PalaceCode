function logar() {
   var user = document.getElementById('email').value;
   var senha = document.getElementById('senha').value;
 
   if (user === "admin@hotmail.com" && senha === "admin") {
     location.href = "dash.html";
   } else {
     alert("Credenciais inválidas. Por favor, tente novamente.");
   }
 }