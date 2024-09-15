
document.getElementById("registroForm").addEventListener("submit", function(event) {
    
    event.preventDefault();

    const nombreCompleto = document.getElementById("nombreCompleto").value;
    const fechaNacimiento = document.getElementById("fechaNacimiento").value;
    const password = document.getElementById("password").value;
    const errorMsg = document.getElementById("errorMsg");


    // Validación para el nombre
    const nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(nombreCompleto)) {
        errorMsg.textContent = "El nombre solo puede contener letras y espacios.";
        return;
    }


    // Validación para la fecha de nacimieto
    const fechaActual = new Date().toISOString().split("T")[0];
    if (fechaNacimiento >= fechaActual) {
        errorMsg.textContent = "Fecha inválida.";
        return;
    }


    // Validación para la contraseña
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
    if (!passwordRegex.test(password)) {
        errorMsg.textContent = "La contraseña debe tener 8 caracteres, una mayúscula, un número y un carácter especial como mínimo.";
        return;
    }


    // Si ninguna validación falla, entonces no regresa y entra aqui
    window.location.href = "login.html";
});
