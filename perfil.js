
// Elementos del perfil
const name = document.getElementById('name');
const username = document.getElementById('username');
const gender = document.getElementById('gender');
const birthday = document.getElementById('birth');
const email = document.getElementById('email');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const photo = document.getElementById('NewPhoto');
const editBtn = document.getElementById('editBtn');
const saveBtn = document.getElementById('saveBtn');
const cancelBtn = document.getElementById('cancelBtn');
const statusMessage = document.getElementById('errorMsg');



// VALIDACIONES

// Validar nombre
function validarNombre(nombre) {
    const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
    return nombreRegex.test(nombre);
}

// Validar contraseña 
function validarContraseña(contraseña) {
    const contraseñaRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+={}|[\]:";'<>?,./]).{8,}$/;
    return contraseñaRegex.test(contraseña);
}

// Validar fecha de nacimiento
function validarFechaNacimiento(fecha) {
    const fechaActual = new Date();
    const fechaNacimiento = new Date(fecha);
    return fechaNacimiento <= fechaActual;
}

// Validar email
function validarEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
}



// Habilitar edición
function habilitarEdicion() {
    name.disabled = false;
    username.disabled = false;
    gender.disabled = false;
    birthday.disabled = false;
    email.disabled = false;
    password.disabled = false;
    confirmPassword.disabled = false;
    photo.disabled = false;
    editBtn.disabled = true;
    saveBtn.disabled = false;
    cancelBtn.disabled = false;
}

// Deshabilitar edición y restaurar valores por defecto
function cancelarEdicion() {
    name.value = "Daniel Uriel Max Moreno Ysiel"; 
    username.value = "Dummy";     
    gender.value = "Masculino";    
    birthday.value = "2024-09-16";      
    email.value = "dani.morysi@hotmail.com"; 
    password.value = "123+dummY";
    confirmPassword.value = "123+dummY";
    photo.value = "";
    name.disabled = true;
    username.disabled = true;
    gender.disabled = true;
    birthday.disabled = true;
    email.disabled = true;
    password.disabled = true;
    confirmPassword.disabled = true;
    photo.disabled = true;
    editBtn.disabled = false;
    saveBtn.disabled = true;
    cancelBtn.disabled = true;
    statusMessage.textContent = "";
}

// Guardar cambios
function guardarCambios() {

    if (!validarNombre(name.value)) {
        statusMessage.textContent = "El nombre no es válido.";
        return;
    }

    if (!validarEmail(email.value)) {
        statusMessage.textContent = "Introduce un correo electrónico válido.";
        return;
    }

    if (!validarFechaNacimiento(birthday.value)) {
        statusMessage.textContent = "Fecha de nacimiento inválido.";
        return;
    }

    if (!validarContraseña(password.value)) {
        statusMessage.textContent = "La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.";
        return;
    }

    if (password.value !== confirmPassword.value) {
        statusMessage.textContent = "Las contraseñas no coinciden.";
        return;
    }


    statusMessage.textContent = "Información guardada correctamente.";
    name.disabled = true;
    username.disabled = true;
    gender.disabled = true;
    birthday.disabled = true;
    email.disabled = true;
    password.disabled = true;
    confirmPassword.disabled = true;
    photo.disabled = true;
    editBtn.disabled = false;
    saveBtn.disabled = true;
    cancelBtn.disabled = true;
}

// Eventos de los botones
editBtn.addEventListener("click", habilitarEdicion);
cancelBtn.addEventListener("click", cancelarEdicion);
saveBtn.addEventListener("click", guardarCambios);
