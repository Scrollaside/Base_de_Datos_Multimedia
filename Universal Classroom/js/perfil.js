
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
    location.reload();
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
    const passwordRegex = /^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;;
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
    
        const formData = new FormData();
        const usuarioID = document.getElementById("profileForm").getAttribute("data-usuario-id");
        formData.append("id", usuarioID);
        formData.append("nombreCompleto", name.value);
        formData.append("nombreUsuario", username.value);
        formData.append("genero", gender.value);
        formData.append("fechaNacimiento", birthday.value);
        formData.append("email", email.value);
        formData.append("contraseña", password.value);
        formData.append("confirmarContraseña", confirmPassword.value);
        
        // Si hay una nueva foto seleccionada
        if (photo.files[0]) {
            formData.append("foto", photo.files[0]);
        }

        fetch("perfil.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                statusMessage.textContent = "Información guardada correctamente.";
                // Deshabilita los campos nuevamente después de guardar
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
            } else {
                statusMessage.textContent = "Error al guardar los cambios: " + data.message;
            }
        })
        .catch(error => {
            statusMessage.textContent = "Error de red: " + error.message;
        });
    } 

    


// Eventos de los botones
editBtn.addEventListener("click", habilitarEdicion);
cancelBtn.addEventListener("click", cancelarEdicion);
saveBtn.addEventListener("click", guardarCambios);

