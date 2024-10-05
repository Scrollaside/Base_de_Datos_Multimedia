
document.getElementById("loginForm").addEventListener("submit", function(event) {

    event.preventDefault();
    
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    if (usuario === "1" && password === "1") {
        window.location.href = "index.html";
    } 
    else if(usuario === "2" && password === "2"){
        window.location.href = "instructor.html";
    }
    else if(usuario === "3" && password === "3"){
        window.location.href = "bloqueoDesbloqueo.html";
    }
    else {
        document.getElementById("errorMsg").textContent = "El usuario y/o la contraseña es incorrecta.";
    }
});
