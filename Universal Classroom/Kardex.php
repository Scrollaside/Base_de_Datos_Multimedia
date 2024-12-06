<?php
session_start();
require_once 'config.php'; 
require_once 'Controllers/database.php'; 

// Crear la conexión
$conexion = new db(); 

require_once 'Controllers/KardexController.php';

$controller = new KardexController($conexion);

// Obtener los datos del usuario
$userId = $_SESSION['ID']; 

// Obtener los niveles y cursos
$niveles = $controller->obtenerNiveles($userId);
$cursos = $controller->obtenerCursosConDetalles($userId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/kardexEstilo.css">    
</head>
<body>

    <div class="filters">
        <label for="fecha-inicio">Desde:</label>
        <input type="date" id="fecha-inicio">
        
        <label for="fecha-fin">Hasta:</label>
        <input type="date" id="fecha-fin">
        
        <label for="categoria">Categoría:</label>
        <select id="categoria">
            <option value="todas">Todas</option>
            <option value="tecnologia">Tecnología</option>
            <option value="programacion">Programación</option>
            <option value="dibujo">Dibujo</option>
            <option value="web">Web</option>
            <option value="videojuegos">VideoJuegos</option>
            <option value="basededatos">Base de Datos</option>
            <option value="marketing">Marketing</option>
        </select>

        <label for="estado">Estado del Curso:</label>
        <select id="estado">
            <option value="todos">Todos</option>
            <option value="activos">Activos</option>
            <option value="inactivos">Inactivos</option>
        </select>

        <button onclick="filtrarVentas()">Filtrar</button>
    </div>

    <!-- Mostrar niveles -->
    <h2>Niveles Inscritos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Curso</th>
                <th>Nombre Nivel</th>
                <th>Fecha Inscripción</th>
                <th>Fecha Acceso</th>
                <th>Fecha Finalización</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niveles as $nivel): ?>
                <tr data-id="<?= $nivel['nivel_id'] ?>">
                    <td><?= $nivel['nombre_curso'] ?></td>
                    <td><?= $nivel['nombre_nivel'] ?></td>
                    <td><?= $nivel['FechaInscripcion'] ?></td>
                    <td><?= $nivel['FechaAcceso'] ?></td>
                    <td><?= $nivel['FechaFinalizacion'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Cursos Inscritos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Curso</th>
                <th>Estado</th>
                <th>Fecha Inscripción</th>
                <th>Última Fecha Acceso</th>
                <th>Fecha Finalización</th>
                <?php for ($i = 1; $i <= 9; $i++): ?>
                    <th>Nivel <?= $i ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cursos)): ?>
                <?php foreach ($cursos as $curso): ?>
                    <tr data-id="<?= $curso['curso_id'] ?>">
                        <td><?= $curso['nombre_curso'] ?></td>
                        <td><?= $curso['Estado'] ?></td>
                        <td><?= $curso['fecha_inscripcion'] ?></td>
                        <td><?= $curso['ultima_fecha_acceso'] ?></td>
                        <td><?= $curso['fecha_finalizacion'] ?? 'Incompleto' ?></td>
                        <?php foreach ($curso['niveles'] as $estado): ?>
                            <td class="<?= $estado === 'N/A' ? 'na' : '' ?>"><?= $estado ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="14">No hay cursos inscritos para mostrar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button class="scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">↑</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/loadNavBar.js"></script>
    <script src="js/kardex.js"></script>
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
