<?php
session_start();
require_once 'config.php'; 
require_once 'Controllers/database.php'; 
require_once PROJECT_ROOT . '/Models/EdicionCurso.php';

// Crear la conexión
$conexion = new db(); 

require_once 'Controllers/KardexController.php';

$controller = new KardexController($conexion);

// Obtener los datos del usuario
$userId = $_SESSION['ID']; 

// Obtener los niveles y cursos
$niveles = $controller->obtenerNiveles($userId);
$cursos = $controller->obtenerCursosConDetalles($userId);
$edicionCurso = new EdicionCurso($conexion);

// Obtener todas las categorías disponibles
$todasCategorias = $edicionCurso->obtenerTodasLasCategorias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex de Alumno</title>
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/kardexEstilo.css">    
</head>
<body>

 <!-- FILTROS -->
 <div class="filters">
        <label for="fecha-inicio">Desde:</label>
        <input type="date" id="fecha-inicio">
        
        <label for="fecha-fin">Hasta:</label>
        <input type="date" id="fecha-fin">
        
        <label for="categoria">Categoría:</label>      
        <select id="categoria">
            <option value="todas">Todas</option>
                <?php foreach ($todasCategorias as $categoria): ?>
                    <option value="<?= $categoria['ID'] ?>"><?= htmlspecialchars($categoria['Nombre']); ?></option>
                <?php endforeach; ?>
        </select>

        <label for="progreso">Nivel de progreso:</label>
        <select id="progreso">
            <option value="todos">Todos</option>
            <option value="terminados">Terminados</option>
        </select>        
        
        <label for="estado">Estado del Curso:</label>
        <select id="estado">
            <option value="todos">Todos</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>   

    </div>

    

    <!-- CURSOS -->
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
    </table><br><br><br><br>
   
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="js/loadNavBar.js"></script>
    <script src="js/kardex.js"></script>
        
</body>
</html>
