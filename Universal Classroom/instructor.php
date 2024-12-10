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
            

            <?php if (!empty($curso['Imagen'])): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($curso['Imagen']); ?>" class="img-fluid rounded-start" alt="Imagen del curso">
            <?php else: ?>
                <img src="https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" class="img-fluid rounded-start" alt="Imagen no disponible">
            <?php endif; ?>


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

    <script>
        document.querySelectorAll('.estado-btn').forEach(button => {
            button.addEventListener('click', async () => {
                const cursoId = button.getAttribute('data-id');
                const estadoActual = button.getAttribute('data-estado');
                const nuevoEstado = estadoActual === 'Activo' ? 'Inactivo' : 'Activo';

                try {
                    const response = await fetch('./Controllers/EstadoController.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ cursoId, nuevoEstado }),
                    });

                    const data = await response.json();
                    if (data.success) {
                        button.innerText = nuevoEstado === 'Activo' ? 'Deshabilitar Curso' : 'Habilitar Curso';
                        button.setAttribute('data-estado', nuevoEstado);

                        const cursoDiv = document.getElementById(`curso-${cursoId}`);
                        cursoDiv.style.opacity = nuevoEstado === 'Activo' ? '1' : '0.5';

                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                } catch (error) {
                    console.error('Error al actualizar el estado:', error);
                    alert('Ocurrió un error al intentar actualizar el estado.');
                }
            });
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
