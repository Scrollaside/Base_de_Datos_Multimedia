<?php
require_once 'config.php';
require_once 'Models/Curso.php';

$cursoModel = new Curso();

function obtenerCursosMejoresCalificados($cursoModel) {
    return $cursoModel->obtenerCursosPorCriterio('MejoresCalificados');
}

function obtenerCursosMasVendidos($cursoModel) {
    return $cursoModel->obtenerCursosPorCriterio('MasVendidos');
}

function obtenerCursosMasRecientes($cursoModel) {
    return $cursoModel->obtenerCursosPorCriterio('MasRecientes');
}

$mejoresCalificados = obtenerCursosMejoresCalificados($cursoModel);
$masVendidos = obtenerCursosMasVendidos($cursoModel);
$masRecientes = obtenerCursosMasRecientes($cursoModel);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universal Classroom: Aprende con nosotros</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- TITULOS -->
    <h1 align="center">UNIVERSAL CLASSROOM</h1>

    <p class="InfoPage">En un mundo en constante evolución, la educación es la clave para mantenerse adelante. Nuestra plataforma ofrece una amplia variedad de cursos en línea diseñados para ayudarte a desarrollar nuevas habilidades, mejorar tus conocimientos y alcanzar tus objetivos personales y profesionales.<br><br>
    Con Universal Classroom, puedes aprender a tu propio ritmo, en cualquier momento y lugar. Nuestros cursos están creados por expertos en cada campo y están diseñados para ser accesibles, interactivos y fáciles de seguir.</p>
    <br><br><br>


    <!-- Contenido principal -->
    <div id="course-details-container">
        <!-- Aquí se cargará dinámicamente el contenido de detalleCurso.php -->

        <!-- Cursos Mejor Calificados -->
        <h2>Mejores Calificados</h2>
        <div class="cursos-container">
            <?php foreach ($mejoresCalificados as $curso): ?>
                <div class="curso">
                    <?php if (!empty($curso['Imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['Imagen']); ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
                    <?php else: ?>
                        <img src="ruta/a/imagen_placeholder.jpg" class="img-fluid rounded-start" alt="Imagen no disponible">
                    <?php endif; ?>

                    <div class="detalles">
                        <h3 class="titulo-by-curso"><?= htmlspecialchars($curso['Titulo']) ?></h3>
                        <p>Calificación: <?= htmlspecialchars($curso['PromedioCalificacion']) ?></p>
                        <h3><?= htmlspecialchars($curso['Descripcion']) ?></h3>
                        <h4><?= htmlspecialchars($curso['Categorias']) ?></h4>
                        <a class="curse-btn" id="<?= htmlspecialchars($curso['ID']) ?>">Detalles del Curso</a>
                    </div>                    
                </div>
            <?php endforeach; ?>
        </div>
            
        <!-- Cursos Más Vendidos -->
        <h2>Más Vendidos</h2>
        <div class="cursos-container">
            <?php foreach ($masVendidos as $curso): ?>
                <div class="curso">
                    <?php if (!empty($curso['Imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['Imagen']); ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
                    <?php else: ?>
                        <img src="ruta/a/imagen_placeholder.jpg" class="img-fluid rounded-start" alt="Imagen no disponible">
                    <?php endif; ?>

                    <div class="detalles">
                        <h3 class="titulo-by-curso"><?= htmlspecialchars($curso['Titulo']) ?></h3>
                        <p>Calificación: <?= htmlspecialchars($curso['PromedioCalificacion']) ?></p>
                        <h3><?= htmlspecialchars($curso['Descripcion']) ?></h3>
                        <h4><?= htmlspecialchars($curso['Categorias']) ?></h4>
                        <a class="curse-btn" id="<?= htmlspecialchars($curso['ID']) ?>">Detalles del Curso</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            
        <!-- Cursos Más Recientes -->
        <h2>Más Recientes</h2>
        <div class="cursos-container">
            <?php foreach ($masRecientes as $curso): ?>
                <div class="curso">
                    <?php if (!empty($curso['Imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['Imagen']); ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
                    <?php else: ?>
                        <img src="ruta/a/imagen_placeholder.jpg" class="img-fluid rounded-start" alt="Imagen no disponible">
                    <?php endif; ?>

                    <div class="detalles">
                        <h3 class="titulo-by-curso"><?= htmlspecialchars($curso['Titulo']) ?></h3>
                        <p>Calificación: <?= htmlspecialchars($curso['PromedioCalificacion']) ?></p>
                        <h3><?= htmlspecialchars($curso['Descripcion']) ?></h3>
                        <h4><?= htmlspecialchars($curso['Categorias']) ?></h4>
                        <a class="curse-btn" id="<?= htmlspecialchars($curso['ID']) ?>">Detalles del Curso</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


     <!-- EXPLORAR MAS -->
     <div class="explore-more">
        <a href="Busqueda.php" class="explore-btn">EXPLORA MÁS</a>
    </div>

    <button class="scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">↑</button>


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
    <script src="js/loadCourses.js"></script>

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
            const cursos = document.querySelectorAll('.curso');
            
            cursos.forEach(curso => {
                const calificacionTexto = curso.querySelector('.detalles p:nth-child(2)').innerText;
                const calificacion = parseFloat(calificacionTexto.split(': ')[1]); 

    
                curso.querySelector('.detalles p:nth-child(2)').innerHTML = `Calificación: ${mostrarEstrellas(calificacion)}`;
            });
        };
    </script>    

    <script>
        window.addEventListener('scroll', function () {
            const scrollButton = document.querySelector('.scroll-to-top');
            if (window.scrollY > 300) {
                scrollButton.style.display = 'flex';
            } else {
                scrollButton.style.display = 'none';
            }
        });
    </script>
    
</body>
</html>
