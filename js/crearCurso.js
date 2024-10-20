document.addEventListener('DOMContentLoaded', () => {
    const categoriasSelect = document.getElementById("categorias");
    const agregarCategoriaBtn = document.getElementById("agregar-categoria");
    const categoriasSeleccionadasDiv = document.getElementById("categorias-seleccionadas");
    const form = document.getElementById("crear-curso-form");
    
    const categoriasSeleccionadas = [];

    // Función para agregar categorías
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
        window.location.href = 'instructor.php'; 
    });

    // Manejar la creación de niveles con la nueva validación
    document.getElementById("niveles").addEventListener("input", function() {
        let numNiveles = this.value;

        // Limitar la longitud a un dígito
        if (numNiveles.length > 1) {
            this.value = numNiveles.slice(0, 1);
        }

        // Validar que el número sea entre 1 y 9
        numNiveles = parseInt(this.value);
        if (isNaN(numNiveles) || numNiveles < 1 || numNiveles > 9) {
            this.value = '';
        } else {
            // Lógica para mostrar los niveles si es un número válido
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
        }
    });
});
