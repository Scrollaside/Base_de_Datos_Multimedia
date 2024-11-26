<?php
require_once __DIR__ . '/Controllers/CourseSearchController.php';

$controller = new CourseSearchController();

// Obtener los parámetros de búsqueda
$titulo = $_GET['titulo'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$usuario = $_GET['usuario'] ?? '';
$fechaInicio = $_GET['fechaInicio'] ?? '';
$fechaFin = $_GET['fechaFin'] ?? '';

// Ejecutar búsqueda
$cursos = $controller->buscarCursos($titulo, $categoria, $usuario, $fechaInicio, $fechaFin);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/busqueda.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Búsqueda de Cursos</h2>

    <!-- Formulario de búsqueda -->
    <form id="searchForm" method="GET" action="Busqueda.php">
        <div class="row mb-3">
            <!-- Búsqueda por título del curso -->
            <div class="col-md-6 mb-3">
                <label for="tituloCurso" class="form-label">Título del Curso</label>
                <input type="text" class="form-control" id="tituloCurso" name="titulo" placeholder="Escribe el título del curso" value="<?php echo htmlspecialchars($_GET['titulo'] ?? ''); ?>">
            </div>

            <!-- Búsqueda por categoría -->
            <div class="col-md-6 mb-3">
                <label for="categoriaCurso" class="form-label">Categoría del Curso</label>
                <select class="form-select" id="categoriaCurso" name="categoria">
                    <option value="">Todas</option>
                    <!-- Este PHP inserta todas las categorías dinámicamente -->
                    <?php
                    require_once __DIR__ . '/Controllers/database.php';
                    $db = new db();
                    $conexion = $db->conectar();
                    $stmt = $conexion->query("SELECT Nombre FROM Categoria");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = (isset($_GET['categoria']) && $_GET['categoria'] === $row['Nombre']) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($row['Nombre']) . "\" $selected>" . htmlspecialchars($row['Nombre']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Búsqueda por usuario creador del curso -->
            <div class="col-md-6 mb-3">
                <label for="usuarioPublicador" class="form-label">Usuario que publicó el curso</label>
                <input type="text" class="form-control" id="usuarioPublicador" name="usuario" placeholder="Nombre del usuario" value="<?php echo htmlspecialchars($_GET['usuario'] ?? ''); ?>">
            </div>

            <!-- Búsqueda por rango de fechas de publicación -->
            <div class="col-md-6 mb-3">
                <label for="fechaPublicacion" class="form-label">Rango de Fechas de Publicación</label>
                <div class="input-group">
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php echo htmlspecialchars($_GET['fechaInicio'] ?? ''); ?>">
                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo htmlspecialchars($_GET['fechaFin'] ?? ''); ?>">
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
            <?php if (count($cursos) > 0): ?>
                <?php foreach ($cursos as $curso): ?>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <!-- Imagen del curso -->
                            <div class="col-md-4">
                                <?php if (!empty($curso['Imagen'])): ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['Imagen']); ?>" class="img-fluid rounded-start" alt="Imagen del curso">
                                <?php else: ?>
                                    <img src="ruta/a/imagen_placeholder.jpg" class="img-fluid rounded-start" alt="Imagen no disponible">
                                <?php endif; ?>
                            </div>
                                
                            <!-- Detalles del curso -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($curso['Titulo']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($curso['Descripcion']); ?></p>
                                    <p class="card-text">Calificación: <?php echo htmlspecialchars($curso['PromedioCalificacion']); ?></p>
                                    <p class="card-text">Creador: <?php echo htmlspecialchars($curso['Creador']); ?></p>
                                    <button class="btn btn-primary" id="<?php echo htmlspecialchars($curso['ID']); ?>">Ver Curso</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron cursos activos.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
        <div class="contact-info">
            <p>Contacto: classroom.universal@gmail.com</p>
            <p>Teléfono: +52 813385 9055</p>
            <p>Dirección: Ciudad Universitaria, San Nicolás, Nuevo León</p><br>
            <p>Max Osvaldo de León Cantú 1911767</p>
            <p>Aldo Rogelio González Zapata 1998739</p>
            <p>Guillermo Javier Morin Tristan 2016699</p>
            <p>Alberto Kezan Guardiola Ayala 1922814</p>
        </div>
    </footer>


<script src="js/loadNavBar.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function mostrarEstrellas(calificacion) {
            const estrellasLlenas = Math.floor(calificacion);
            const mediaEstrella = calificacion % 1 >= 0.5;
            let estrellasHTML = '';
    

            for (let i = 0; i < estrellasLlenas; i++) {
                estrellasHTML += '<i class="bi bi-star-fill text-warning"></i>';
            }
    

            if (mediaEstrella) {
                estrellasHTML += '<i class="bi bi-star-half text-warning"></i>';
            }
    

            const estrellasRestantes = 5 - estrellasLlenas - (mediaEstrella ? 1 : 0);
            for (let i = 0; i < estrellasRestantes; i++) {
                estrellasHTML += '<i class="bi bi-star text-warning"></i>';
            }
    
            return estrellasHTML;
        }
    

        window.onload = function() {
            const cursos = document.querySelectorAll('.resultadosBusqueda');
            
            cursos.forEach(curso => {
                const calificacionTexto = curso.querySelector('.detalles p:nth-child(2)').innerText;
                const calificacion = parseFloat(calificacionTexto.split(': ')[1]); 

    
                curso.querySelector('.detalles p:nth-child(2)').innerHTML = `Calificación: ${mostrarEstrellas(calificacion)}`;
            });
        };
    </script>

</body>
</html>
