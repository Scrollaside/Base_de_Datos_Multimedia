
document.getElementById("loginForm").addEventListener("submit", function(event) {

    event.preventDefault();
    
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    if (usuario === "1" && password === "1") {
        localStorage.setItem("ID_Usuario", 1);
        localStorage.setItem("Nombre_Usuario", "Usuario1");
        localStorage.setItem("Type_Usuario", 1);
        window.location.href = "index.php";
    } 
    else if(usuario === "2" && password === "2"){
        localStorage.setItem("ID_Usuario", 2);
        localStorage.setItem("Nombre_Usuario", "Usuario2");
        localStorage.setItem("Type_Usuario", 2);
        window.location.href = "instructor.php";
    }
    else if(usuario === "3" && password === "3"){
        localStorage.setItem("ID_Usuario", 3);
        localStorage.setItem("Nombre_Usuario", "Usuario3");
        localStorage.setItem("Type_Usuario", 3);
        window.location.href = "bloqueoDesbloqueo.php";
    }
    else {
        document.getElementById("errorMsg").textContent = "El usuario y/o la contraseña es incorrecta.";
    }
});
