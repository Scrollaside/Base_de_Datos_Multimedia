<?php
session_start();
require_once 'config.php'; 
require_once 'Controllers/database.php'; 

// Crear la conexión
$conexion = new db(); 

require_once 'Controllers/KardexController.php';

$controller = new KardexController($conexion);

// Obtener los datos del usuario
$userId = $_SESSION['ID']; // Suponiendo que el ID del usuario está en la sesión

// Obtener los niveles y cursos
$niveles = $controller->obtenerNiveles($userId);
$cursos = $controller->obtenerCursos($userId);
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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 90px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
    </style>
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
                <th>ID Nivel</th>
                <th>Nombre Nivel</th>
                <th>Nombre Curso</th>
                <th>Fecha Inscripción</th>
                <th>Fecha Acceso</th>
                <th>Fecha Finalización</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niveles as $nivel): ?>
                <tr>
                    <td><?= $nivel['nivel_id'] ?></td>
                    <td><?= $nivel['nombre_nivel'] ?></td>
                    <td><?= $nivel['nombre_curso'] ?></td>
                    <td><?= $nivel['FechaInscripcion'] ?></td>
                    <td><?= $nivel['FechaAcceso'] ?></td>
                    <td><?= $nivel['FechaFinalizacion'] ?></td>
                    <td><?= $nivel['Estado'] ? 'Activo' : 'Inactivo' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Mostrar cursos -->
    <h2>Cursos Inscritos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Curso</th>
                <th>Nombre Curso</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td><?= $curso['curso_id'] ?></td>
                    <td><?= $curso['nombre_curso'] ?></td>
                    <td><?= $curso['estado_curso'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/loadNavBar.js"></script>
    <script src="js/kardex.js"></script>

</body>
</html>
