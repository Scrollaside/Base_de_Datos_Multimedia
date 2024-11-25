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



    <!-- Contenido principal -->
    <div id="course-details-container">
        <!-- Aquí se cargará dinámicamente el contenido de detalleCurso.php -->

        <!-- Cursos Mejor Calificados -->
<h2>Mejores Calificados</h2>
<div class="cursos-container">
    <?php foreach ($mejoresCalificados as $curso): ?>
        <div class="curso">
            <img src="<?= htmlspecialchars($curso['Imagen']) ?>" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
            <div class="detalles">
                <h3><?= htmlspecialchars($curso['Titulo']) ?></h3>
                <p>Calificación: <?= htmlspecialchars($curso['PromedioCalificacion']) ?></p>
                <p><?= htmlspecialchars($curso['Descripcion']) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Cursos Más Vendidos -->
<h2>Más Vendidos</h2>
<div class="cursos-container">
    <?php foreach ($masVendidos as $curso): ?>
        <div class="curso">
            <img src="<?= htmlspecialchars($curso['Imagen']) ?>" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
            <div class="detalles">
                <h3><?= htmlspecialchars($curso['Titulo']) ?></h3>
                <p>Vendidos: <?= htmlspecialchars($curso['CantidadVendidas']) ?></p>
                <p><?= htmlspecialchars($curso['Descripcion']) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Cursos Más Recientes -->
<h2>Más Recientes</h2>
<div class="cursos-container">
    <?php foreach ($masRecientes as $curso): ?>
        <div class="curso">
            <img src="<?= htmlspecialchars($curso['Imagen']) ?>" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
            <div class="detalles">
                <h3><?= htmlspecialchars($curso['Titulo']) ?></h3>
                <p>Creado el: <?= htmlspecialchars($curso['FechaCreacion']) ?></p>
                <p><?= htmlspecialchars($curso['Descripcion']) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    </div>





     <!-- EXPLORAR MAS -->
     <div class="explore-more">
        <a href="Busqueda.php" class="explore-btn">EXPLORA MÁS</a>
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
    
</body>
</html>
