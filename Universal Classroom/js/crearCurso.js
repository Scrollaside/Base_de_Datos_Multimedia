document.addEventListener('DOMContentLoaded', () => {
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

        const formData = new FormData();
        formData.append("titulo", titulo);
        formData.append("imagen", imagen);
        formData.append("descripcion", descripcion);
        formData.append("costo", costo);
        formData.append("cantidadNiveles", cantidadNiveles);

        try {
            const response = await fetch('Models/Curso.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alert('¡Curso creado con éxito! ID: ' + result.cursoId);
                window.location.href = 'instructor.php';
            } else {
                alert(result.message || 'Error al crear el curso.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un problema al enviar la solicitud.');
        }
    });
});
