<?php
session_start();
require_once 'config.php';
require_once 'Models/Curso.php';

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['ID'])) {
    echo "<p>No hay usuario logueado.</p>";
    exit;
}


$usuarioID = $_SESSION['ID'];
$cursoModel = new Curso();

// Manejo de la actualización de estado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['curso_id'], $_POST['nuevo_estado'])) {
    $cursoID = $_POST['curso_id'];
    $nuevoEstado = $_POST['nuevo_estado'] === 'Activo' ? 'Inactivo' : 'Activo';
    $cursoModel->actualizarEstadoCurso($cursoID, $nuevoEstado);
    echo json_encode(['success' => true, 'estado' => $nuevoEstado]);
    exit;
}

$misCursos = $cursoModel->obtenerCursoPorCreador($usuarioID);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis cursos</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    
    <br><h1 align="center">CURSOS IMPARTIDOS</h1>

    <div align="center">
        <?php foreach ($misCursos as $curso): ?>
        <div class="curso" id="curso-<?= htmlspecialchars($curso['ID']) ?>" style="opacity: <?= $curso['Estado'] === 'Activo' ? '1' : '0.5' ?>">
            <img src="<?= htmlspecialchars($curso['Imagen']) ?>" alt="<?= htmlspecialchars($curso['Titulo']) ?>">
            <div class="curso-info" align="left">
                <h2 class="titulo-by-curso"><?= htmlspecialchars($curso['Titulo']) ?></h2>
                <p><?= htmlspecialchars($curso['Descripcion']) ?></p>
                <div class="detalles">
                    <p>Calificación: <?= htmlspecialchars($curso['PromedioCalificacion']) ?></p>
                    <p>Estado: <?= htmlspecialchars($curso['Estado']) ?></p>
                    <p>Fecha de creación: <?= htmlspecialchars($curso['FechaCreacion']) ?></p>
                </div>
                <a href="detallesCurso.php" class="curso-link" id="<?= htmlspecialchars($curso['ID']) ?>">Ver Detalles</a>
                <button class="curso-link estado-btn" data-id="<?= htmlspecialchars($curso['ID']) ?>" data-estado="<?= htmlspecialchars($curso['Estado']) ?>">
                    <?= $curso['Estado'] === 'Activo' ? 'Deshabilitar Curso' : 'Habilitar Curso' ?>
                </button>
                <a href="editarCurso.php?id=<?= htmlspecialchars($curso['ID']) ?>" class="curso-link">Editar Curso</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
  
    
    <button class="scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">↑</button><br><br>

    <!-- Curso 4
     <div class="curso" id="curso4">
                <img src="https://img-c.udemycdn.com/course/750x422/5066618_1a4f.jpg" alt="Imagen del curso">
                <div class="curso-info" align="left">
                    <h2>Curso de C#</h2>
                    <p>Descubre las bases para el lenguaje C# y el uso de recursos por forms, ven y aprende de una manera fácil y divertida todos los componentes que puedes utilizar.</p><br>

                    <div class="detalles">
                        <p>Categorías: Tecnología, Programación</p>
                        <p>Calificación: 7.4/10</p>
                    </div>

                    <a href="detallesCurso.php" class="curso-link">Explorar Clase</a>
                    <button class="curso-link" onclick="toggleCurso(4)">Deshabilitar Curso</button>
                </div>
            </div>
    </div>
    -->


    <script>
        document.querySelectorAll('.estado-btn').forEach(button => {
            button.addEventListener('click', () => {
                const cursoId = button.dataset.id;
                const estadoActual = button.dataset.estado;

                fetch('instructor.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ curso_id: cursoId, nuevo_estado: estadoActual })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cursoDiv = document.getElementById(`curso-${cursoId}`);
                        const nuevoEstado = data.estado;
                        cursoDiv.style.opacity = nuevoEstado === 'Activo' ? '1' : '0.5';
                        button.dataset.estado = nuevoEstado;
                        button.textContent = nuevoEstado === 'Activo' ? 'Deshabilitar Curso' : 'Habilitar Curso';
                        cursoDiv.querySelector('.detalles p:nth-child(2)').textContent = `Estado: ${nuevoEstado}`;
                        alert("El estado del curso se ha cambiadocon éxito.");
                    }
                });
            });
        });

        window.addEventListener('scroll', () => {
            const scrollButton = document.querySelector('.scroll-to-top');
            scrollButton.style.display = window.scrollY > 300 ? 'flex' : 'none';
        });
    </script>

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
                const calificacionTexto = curso.querySelector('.detalles p:nth-child(1)').innerText;
                const calificacion = parseFloat(calificacionTexto.split(': ')[1]); 

    
                curso.querySelector('.detalles p:nth-child(1)').innerHTML = `Calificación: ${mostrarEstrellas(calificacion)}`;
            });
        };
    </script> 

    <script src="js/loadNavBar.js"></script>

</body>
</html>
