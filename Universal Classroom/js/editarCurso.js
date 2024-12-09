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


document.addEventListener('DOMContentLoaded', () => {
    const agregarBtn = document.getElementById('btnAgregarCategoria');
    const actualizarBtn = document.getElementById('guardarCategoria');
    const listaCategorias = document.getElementById('categoriasActuales');

    // Agregar categoría a la lista
    agregarBtn.addEventListener('click', () => {
        const selectCategorias = document.getElementById('selectCategorias');
        const categoriaId = selectCategorias.value;
        const categoriaNombre = selectCategorias.selectedOptions[0].text;

        if (categoriaId === '') {
            alert('Por favor, selecciona una categoría.');
            return;
        }

        // Evitar duplicados
        const existe = Array.from(listaCategorias.children).some(
            (li) => li.dataset.id === categoriaId
        );
        if (existe) {
            alert('Esta categoría ya ha sido agregada.');
            return;
        }

        // Crear nuevo elemento en la lista
        const nuevaCategoria = document.createElement('li');
        nuevaCategoria.dataset.id = categoriaId;
        nuevaCategoria.innerHTML = `
            ${categoriaNombre} <button id="cancelBtn" class="btnEliminarCategoria">X</button>
        `;
        listaCategorias.appendChild(nuevaCategoria);
    });

    // Eliminar categoría de la lista
    listaCategorias.addEventListener('click', (e) => {
        if (e.target.classList.contains('btnEliminarCategoria')) {
            e.target.parentElement.remove();
        }
    });

    // Verificar si la lista está vacía
    function verificarListaVacia() {
        if (listaCategorias.children.length === 0) {
            return false;
        }
        else {
            return true;
        }
    }

    // Actualizar categorías en la base de datos
    actualizarBtn.addEventListener('click', () => {

        if(!verificarListaVacia()){
            alert('El curso debe tener categorias.');
        }
        else {
            const cursoId = document.getElementById("cursoId").value; // ID del curso
            const categoriasSeleccionadas = Array.from(document.querySelectorAll("#categoriasActuales li"))
               .map(li => li.dataset.id);


            fetch("Controllers/EdicionCursoController.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    cursoId,
                    categorias: categoriasSeleccionadas
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Categorías actualizadas correctamente.");
                } else {
                    alert("Error al actualizar las categorías.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Categorías actualizadas correctamente.");
            });
        }

    });

});



// Eventos de los botones
document.getElementById("guardarFoto").addEventListener("click", actualizarFoto);
document.getElementById("guardarInfo").addEventListener("click", actualizarInfo);

