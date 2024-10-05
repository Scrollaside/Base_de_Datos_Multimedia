document.addEventListener('DOMContentLoaded', () => {
    const categoriasSelect = document.getElementById("categorias");
    const agregarCategoriaBtn = document.getElementById("agregar-categoria");
    const categoriasSeleccionadasDiv = document.getElementById("categorias-seleccionadas");
    const form = document.getElementById("crear-curso-form");

    const categoriasSeleccionadas = [];

    // Función para agregar categorpías
    agregarCategoriaBtn.addEventListener("click", () => {
        const categoriaSeleccionada = categoriasSelect.value;

        if (!categoriasSeleccionadas.includes(categoriaSeleccionada)) {
            categoriasSeleccionadas.push(categoriaSeleccionada);
            actualizarCategoriasSeleccionadas();
        }
    });

    // Función para actualizar la lista de categorías seleccionadas
    function actualizarCategoriasSeleccionadas() {
        categoriasSeleccionadasDiv.innerHTML = '';
        categoriasSeleccionadas.forEach(categoria => {
            const categoriaLabel = document.createElement("span");
            categoriaLabel.classList.add("categoria");
            categoriaLabel.textContent = categoria;

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

    // Validación al enviar el formulario
    form.addEventListener('submit', (e) => {
        e.preventDefault();


        if (categoriasSeleccionadas.length === 0) {
            alert('Por favor, selecciona al menos una categoría.');
            return; 
        }

        alert('¡Curso creado con éxito!');
        window.location.href = 'instructor.html'; 
    });

    // Manejar la creación de niveles
    document.getElementById("niveles").addEventListener("change", function() {
        const numNiveles = parseInt(this.value);
        const nivelesContainer = document.getElementById("niveles-container");
        nivelesContainer.innerHTML = ''; 

        for (let i = 1; i <= numNiveles; i++) {
            nivelesContainer.innerHTML += `
                <div class="nivel">
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
                </div>
            `;
        }
    });
});
