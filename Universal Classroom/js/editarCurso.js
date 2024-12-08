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



// Actualizar solo la imagen del curso
function actualizarFoto() {
    const cursoID = new URLSearchParams(window.location.search).get("id");
    const photoInput = document.getElementById('NewPhoto');

    if (!photoInput.files[0]) {
        alert("Por favor selecciona una imagen.");
        return;
    }

    const formData = new FormData();
    formData.append("action", "actualizarImagen");
    formData.append("cursoID", cursoID);
    formData.append("imagen", photoInput.files[0]);

    fetch("Models/EdicionCurso.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Imagen actualizada correctamente.");
            location.reload(); // Recargar para reflejar cambios
        } else {
            alert("Error al actualizar la imagen: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error de red al actualizar la imagen.");
    });
}

// Actualizar solo la información del curso
function actualizarInfo() {
    const cursoID = new URLSearchParams(window.location.search).get("id");
    const titulo = document.getElementById("titulo").value.trim();
    const descripcion = document.getElementById("descripcion").value.trim();
    const costo = parseFloat(document.getElementById("costo").value);

    if (!titulo || !descripcion || isNaN(costo)) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    const formData = new FormData();
    formData.append("action", "actualizarInformacion");
    formData.append("cursoID", cursoID);
    formData.append("titulo", titulo);
    formData.append("descripcion", descripcion);
    formData.append("costo", costo);

    fetch("Models/EdicionCurso.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Información actualizada correctamente.");
        } else {
            alert("Error al actualizar la información: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error de red al actualizar la información.");
    });
}



// Agregar a la lista Categorias
function sumarCategorias() {
            
}



// Actualizar Categorias
function actualizarCategorias() {
            
}
 




// Eventos de los botones
document.getElementById("guardarFoto").addEventListener("click", actualizarFoto);
document.getElementById("guardarInfo").addEventListener("click", actualizarInfo);
agregarCategoria.addEventListener("click", sumarCategorias);
guardarCategoria.addEventListener("click", actualizarCategorias);
