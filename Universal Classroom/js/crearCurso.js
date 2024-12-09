document.addEventListener('DOMContentLoaded', () => {





    //ENVIAR SOLICITUD PARA SUBIR EL CURSO
    const form = document.getElementById("crear-curso-form");

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const titulo = document.getElementById("titulo").value.trim();
        const imagen = document.getElementById("imagen").files[0];
        const descripcion = document.getElementById("presentacion").value.trim();
        const costo = document.getElementById("costo").value;
        const cantidadNiveles = document.getElementById("niveles").value;

        // Validaciones en el frontend
        if (!titulo || !imagen || !descripcion || !costo || !cantidadNiveles) {
            alert("Todos los campos deben ser rellenados.");
            return;
        }

        if (costo <= 0) {
            alert("El costo debe ser mayor a 0.");
            return;
        }

        if (cantidadNiveles < 1) {
            alert("Debe haber al menos 1 nivel.");
            return;
        }

        if (categoriasSeleccionadas.length === 0) {
            alert('Por favor, selecciona al menos una categoría.');
            return; 
        }

        
        const formData = new FormData();
        formData.append("titulo", titulo);
        formData.append("imagen", imagen);
        formData.append("descripcion", descripcion);
        formData.append("costo", costo);
        formData.append("cantidadNiveles", cantidadNiveles);

        
        try {
            // Primera solicitud: Crear curso
            const responseCurso = await fetch('Models/Curso.php', {
                method: 'POST',
                body: formData
            });
    
            const resultCurso = await responseCurso.json();
    
            if (resultCurso.success) {
                const cursoId = resultCurso.cursoId;
    
                // Segunda solicitud: Asociar categorías
                const categoriasData = new FormData();
                categoriasData.append("accion", "insertarCategorias");
                categoriasData.append("cursoId", cursoId);
                categoriasData.append("categorias", JSON.stringify(categoriasSeleccionadas.map(cat => cat.id)));
    
                const responseCategorias = await fetch('Models/Curso.php', {
                    method: 'POST',
                    body: categoriasData
                });
    
                const resultCategorias = await responseCategorias.json();
    
                if (resultCategorias.success) {
                    alert('¡Curso creado con éxito!');
                    window.location.href = 'instructor.php';
                } else {
                    alert(resultCategorias.message || 'Error al asociar categorías.');
                }
            } else {
                alert(resultCurso.message || 'Error al crear el curso.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un problema al enviar la solicitud.');
        }
    });





    //CATEGORIAS
    const categoriasSelect = document.getElementById("categorias");
    const agregarCategoriaBtn = document.getElementById("agregar-categoria");
    const categoriasSeleccionadasDiv = document.getElementById("categorias-seleccionadas");
    
    const categoriasSeleccionadas = [];

    // Función para agregar categorías
    agregarCategoriaBtn.addEventListener("click", () => {
        const categoriaId = categoriasSelect.value;
        const categoriaNombre = categoriasSelect.options[categoriasSelect.selectedIndex].text;

        if (!categoriasSeleccionadas.some(c => c.id === categoriaId)) {
            categoriasSeleccionadas.push({ id: categoriaId, nombre: categoriaNombre });
            actualizarCategoriasSeleccionadas();
        }
    });

    // Función para actualizar la lista de categorías seleccionadas
    function actualizarCategoriasSeleccionadas() {
        categoriasSeleccionadasDiv.innerHTML = '';
        categoriasSeleccionadas.forEach(categoria => {
            const categoriaLabel = document.createElement("span");
            categoriaLabel.classList.add("categoria");
            categoriaLabel.id = `${categoria.id}`;
            categoriaLabel.textContent = categoria.nombre;

            const eliminarBtn = document.createElement("button");
            eliminarBtn.textContent = "X";
            eliminarBtn.addEventListener("click", () => {
                categoriasSeleccionadas.splice(categoriasSeleccionadas.indexOf(categoria), 1);
                actualizarCategoriasSeleccionadas();
            });

            categoriaLabel.appendChild(eliminarBtn);
            categoriasSeleccionadasDiv.appendChild(categoriaLabel);
        });
    }

});




// INPUTS DE NIVELES SEGÚN LA CANTIDAD DE NIVELES QUE PONGAS EN EL CAMPO

// Manejar la creación de niveles con la nueva validación
document.getElementById("niveles").addEventListener("input", function() {
    const nivelesContainer = document.getElementById("niveles-container");
    let numNiveles = this.value;

    // Limitar la longitud a un dígito
    if (numNiveles.length > 1) {
        this.value = numNiveles.slice(0, 1);
    }

    // Validar que el número sea un dígito entre 1 y 9
    if (isNaN(numNiveles) || numNiveles < 1 || numNiveles > 9) {
        nivelesContainer.innerHTML = ""; 
        return;
    }

    // Limpiar el contenedor antes de crear los niveles
    nivelesContainer.innerHTML = "";

    // Crear dinámicamente los formularios de niveles
    for (let i = 1; i <= numNiveles; i++) {
        const nivelDiv = document.createElement("div");
        nivelDiv.classList.add("nivel");

        nivelDiv.innerHTML = `
            <h3>Nivel ${i}</h3>
            <label for="titulo-nivel-${i}">Título del Nivel:</label>
            <input type="text" id="titulo-nivel-${i}" name="titulo-nivel-${i}" required><br>

            <label for="costo-nivel-${i}">Costo Individual del Nivel:</label>
            <input type="number" id="costo-nivel-${i}" name="costo-nivel-${i}" required><br>

            <label for="contenido-nivel-${i}">Contenido:</label>
            <textarea id="contenido-nivel-${i}" name="contenido-nivel-${i}" rows="4"></textarea><br>

            <label for="pdf-nivel-${i}">Adjuntar PDF:</label>
            <input type="file" id="pdf-nivel-${i}" name="pdf-nivel-${i}" accept="application/pdf"><br>

            <label for="link-nivel-${i}">Link Externo:</label>
            <input type="url" id="link-nivel-${i}" name="link-nivel-${i}"><br>

            <label for="video-nivel-${i}">Video:</label>
            <input type="file" id="video-nivel-${i}" name="video-nivel-${i}" accept="video/*" required><br>
        `;

        nivelesContainer.appendChild(nivelDiv);
    }
});

