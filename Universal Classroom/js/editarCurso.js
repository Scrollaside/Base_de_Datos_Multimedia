// Elementos del curso
const photo = document.getElementById('NewPhoto');

const title = document.getElementById('titulo');
const description = document.getElementById('descripcion');
const precio = document.getElementById('costo');



const guardarFoto = document.getElementById('guardarFoto');
const guardarInfo = document.getElementById('guardarInfo');
const guardarCategorias = document.getElementById('guardarCambios');
const statusMessage = document.getElementById('errorMsg');
let validaciones = true;


document.getElementById("guardarCambios").addEventListener("click", () => {
    const cursoID = new URLSearchParams(window.location.search).get("id");
    const titulo = document.getElementById("titulo").value;
    const descripcion = document.getElementById("descripcion").value;
    const costo = document.getElementById("costo").value;
    const imagen = document.getElementById("imagen").files[0];

    const categorias = Array.from(document.querySelectorAll("#categoriasActuales li"))
        .map(li => li.getAttribute("data-id"));

    const formData = new FormData();
    formData.append("id", cursoID);
    formData.append("titulo", titulo);
    formData.append("descripcion", descripcion);
    formData.append("costo", costo);
    formData.append("imagen", imagen);
    formData.append("categorias", JSON.stringify(categorias));

    fetch("Models/EdicionCurso.php", {
        method: "POST",
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Curso actualizado correctamente.");
        } else {
            alert("Error al actualizar: " + data.message);
        }
    });
});

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
    if (validaciones) {
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

    
}

// Actualizar Foto
function guardarFoto() {
   
    // Validar campos vacíos
    if (!photo.value) {
        statusMessage.textContent = "Favor de subir una imagen válida.";
        validaciones = false;
        return;
    }
    
    // Si ninguna validación falla, entonces no regresa y entra aqui
    if (validaciones) {
        const formData = new FormData();
        const usuarioID = document.getElementById("profileForm").getAttribute("data-usuario-id");
                
        // Si hay una nueva foto seleccionada
        if (photo.files[0]) {
            formData.append("foto", photo.files[0]);
        }

        fetch("Models/EdicionCurso.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                statusMessage.textContent = "Información guardada correctamente.";              
            } else {
                statusMessage.textContent = "Error al guardar los cambios: " + data.message;
            }
        })
        .catch(error => {
            statusMessage.textContent = "Error de red: " + error.message;
        });
    } 

    
}



// Eventos de los botones
guardarFoto.addEventListener("click", habilitarEdicion);
guardarInfo.addEventListener("click", cancelarEdicion);
guardarCategorias.addEventListener("click", dsds);
