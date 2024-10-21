<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cursos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>

    

<!-- Contenedor principal de búsqueda -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Búsqueda de Cursos</h2>

    <form id="searchForm">
        <div class="row mb-3">
            <!-- Búsqueda por título del curso (parcial o completo) -->
            <div class="col-md-6 mb-3">
                <label for="tituloCurso" class="form-label">Título del Curso</label>
                <input type="text" class="form-control" id="tituloCurso" placeholder="Escribe una palabra o el título completo del curso">
            </div>

            <!-- Búsqueda por categoría -->
            <div class="col-md-6 mb-3">
                <label for="categoriaCurso" class="form-label">Categoría del Curso</label>
                <select class="form-select" id="categoriaCurso">
                    <option value="">Todas</option>
                    <option value="programacion">Programación</option>
                    <option value="marketing">Marketing</option>
                    <option value="diseño">Diseño</option>
                    <option value="finanzas">Finanzas</option>
                    <option value="creatividad">Creatividad</option>

                    <!-- Agregar más categorías según sea necesario -->
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Búsqueda por usuario que publicó el curso -->
            <div class="col-md-6 mb-3">
                <label for="usuarioPublicador" class="form-label">Usuario que publicó el curso</label>
                <input type="text" class="form-control" id="usuarioPublicador" placeholder="Nombre del usuario que publicó el curso">
            </div>

            <!-- Búsqueda por rango de fechas de publicación -->
            <div class="col-md-6 mb-3">
                <label for="fechaPublicacion" class="form-label">Rango de Fechas de Publicación</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="fechaInicio" placeholder="Desde">
                    <input type="date" class="form-control" id="fechaFin" placeholder="Hasta">
                </div>
            </div>
        </div>

        <!-- Botón de búsqueda -->
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary">Buscar Cursos</button>
            </div>
        </div>
    </form>

    <!-- Resultados de la búsqueda -->
    <div class="mt-5">
        <h4>Resultados de la Búsqueda</h4>
        <div id="resultadosBusqueda">
            <!-- Aquí se mostrarán los resultados de los cursos activos -->
            <!-- Los cursos dados de baja no deben aparecer -->
        </div>
    </div>
</div>

<!-- Bootstrap JS y dependencias de Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/loadNavBar.js"></script>

<!-- Script de ejemplo para simular la búsqueda (puede ser reemplazado con una API) -->
<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Ejemplo de cómo podrías capturar los datos ingresados para la búsqueda
        const titulo = document.getElementById('tituloCurso').value;
        const categoria = document.getElementById('categoriaCurso').value;
        const usuario = document.getElementById('usuarioPublicador').value;
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;

        // Simular resultados de búsqueda para cursos activos
        let cursos = [
            { titulo: 'Curso de Programación en Python', categoria: 'programacion', usuario: 'usuario1', fecha: '2024-09-10', activo: true },
            { titulo: 'Introducción a Marketing Digital', categoria: 'marketing', usuario: 'usuario2', fecha: '2024-08-15', activo: true },
            { titulo: 'Diseño Gráfico Avanzado', categoria: 'diseño', usuario: 'usuario3', fecha: '2024-07-20', activo: true },
            { titulo: 'Curso de Finanzas Personales', categoria: 'finanzas', usuario: 'usuario4', fecha: '2024-06-01', activo: false }, // Curso inactivo
            { titulo: 'Todo sobre Unreal Engine', categoria: 'programacion', usuario: 'usuario5', fecha: '2024-05-01', activo: true },
            { titulo: 'Tips y consejos para Dibujo Digital', categoria: 'diseño', usuario: 'usuario6', fecha: '2024-04-12', activo: true },
            { titulo: 'Origami', categoria: 'creatividad', usuario: 'usuario7', fecha: '2024-03-05', activo: true },
            { titulo: 'Curso de HTML', categoria: 'programacion', usuario: 'usuario8', fecha: '2024-02-15', activo: true }
        ];

        let resultados = cursos.filter(curso => {
            return curso.activo && 
                   (!titulo || curso.titulo.toLowerCase().includes(titulo.toLowerCase())) &&
                   (!categoria || curso.categoria === categoria) &&
                   (!usuario || curso.usuario.toLowerCase().includes(usuario.toLowerCase())) &&
                   (!fechaInicio || new Date(curso.fecha) >= new Date(fechaInicio)) &&
                   (!fechaFin || new Date(curso.fecha) <= new Date(fechaFin));
        });

        mostrarResultados(resultados);
    });

    function mostrarResultados(resultados) {
        const resultadosDiv = document.getElementById('resultadosBusqueda');
        resultadosDiv.innerHTML = '';

        if (resultados.length > 0) {
            resultados.forEach(curso => {
                const cursoDiv = document.createElement('div');
                cursoDiv.classList.add('card', 'mb-3');
                cursoDiv.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${curso.titulo}</h5>
                        <p class="card-text">Categoría: ${curso.categoria}</p>
                        <p class="card-text">Publicado por: ${curso.usuario}</p>
                        <p class="card-text">Fecha de Publicación: ${curso.fecha}</p>
                    </div>
                `;
                resultadosDiv.appendChild(cursoDiv);
            });
        } else {
            resultadosDiv.innerHTML = '<p>No se encontraron cursos activos.</p>';
        }
    }
</script>

</body>
</html>
