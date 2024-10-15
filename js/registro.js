
document.getElementById("registroForm").addEventListener("submit", function(event) {
    
    event.preventDefault();

    const nombreCompleto = document.getElementById("nombreCompleto").value;
    const nombreUsuario = document.getElementById("nombreUsuario").value.trim();
    const fechaNacimiento = document.getElementById("fechaNacimiento").value;
    const foto = document.getElementById("foto").value;
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const errorMsg = document.getElementById("errorMsg");
    let validaciones = true;


    errorMsg.textContent = "";


    // Validar campos vacíos
    if (!nombreCompleto || !nombreUsuario || !fechaNacimiento || !foto || !email || !password) {
        errorMsg.textContent = "Llenar todos los campos del Registro.";
        validaciones = false;
        return;
    }


    // Validación para el nombre
    const nombreRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/;
    if (!nombreRegex.test(nombreCompleto)) {
        errorMsg.textContent = "El nombre solo puede contener letras y espacios.";
        validaciones = false;
        return;
    }


    //Validación para el usuario
    const usuarioRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s0-9]+$/;
    if (!usuarioRegex.test(nombreUsuario)) {
        errorMsg.textContent = "El nombre de usuario solo puede contener letras y números.";
        validaciones = false;
        return;
    }


    // Validación para la fecha de nacimieto
    const fechaActual = new Date().toISOString().split("T")[0];
    if (fechaNacimiento >= fechaActual) {
        errorMsg.textContent = "Fecha inválida.";
        validaciones = false;
        return;
    }


    //Validación de correo electreónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errorMsg.textContent = "El formato del correo electrónico es inválido.";
        validaciones = false;
        return;
    }

    // Validación para la contraseña
    const passwordRegex = /^(?=.*[A-ZÀ-ÿ])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;;
    if (!passwordRegex.test(password)) {
        errorMsg.textContent = "La contraseña debe tener 8 carácteres, mayúscula, número y carácter especial como mínimo.";
        validaciones = false;
        return;
    }

    
    // Si ninguna validación falla, entonces no regresa y entra aqui
    if(validaciones){    
        window.location.href = "login.html";
    }    
});

document.getElementById("fechaNacimiento").setAttribute("max", new Date().toISOString().split("T")[0]);