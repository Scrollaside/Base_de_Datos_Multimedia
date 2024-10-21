
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
let validaciones = true;


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
    confirmPassword.value = "123.dummY";
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
   
    // Validar campos vacíos
    if (!name.value || !username.value || !gender.value || !birthday.value.trim() || !photo.value || 
    !email.value.trim() || !password.value || !confirmPassword.value) {
        statusMessage.textContent = "Llenar todos los campos del Registro.";
        validaciones = false;
        return;
    }


    // Validación para el nombre
    const nombreRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]+$/;
    if (!nombreRegex.test(name.value)) {
        statusMessage.textContent = "El nombre solo puede contener letras y espacios.";
        validaciones = false;
        return;
    }


    //Validación para el usuario
    const usuarioRegex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s0-9]+$/;
    if (!usuarioRegex.test(username.value)) {
        statusMessage.textContent = "El nombre de usuario solo puede contener letras y números.";
        validaciones = false;
        return;
    }


    // Validación para la fecha de nacimieto
    const fechaActual = new Date().toISOString().split("T")[0];
    if (birthday.value.trim() >= fechaActual) {
        statusMessage.textContent = "Fecha inválida.";
        validaciones = false;
        return;
    }


    //Validación de correo electreónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value.trim())) {
        statusMessage.textContent = "El formato del correo electrónico es inválido.";
        validaciones = false;
        return;
    }

    // Validación para la contraseña
    const passwordRegex = /^(?=.*[A-ZÀ-ÿ])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;;
    if (!passwordRegex.test(password.value)) {
        statusMessage.textContent = "La contraseña debe tener 8 carácteres, mayúscula, número y carácter especial como mínimo.";
        validaciones = false;
        return;
    }

    if (password.value !== confirmPassword.value) {
        statusMessage.textContent = "Las contraseñas no coinciden.";
        validaciones = false;
        return;
    }

    
    // Si ninguna validación falla, entonces no regresa y entra aqui
    if(validaciones){    
        //window.location.href = "login.html";
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

