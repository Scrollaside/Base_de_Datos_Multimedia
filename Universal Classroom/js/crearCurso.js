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


