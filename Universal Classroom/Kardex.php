<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kardex de Cursos</title>
    <!-- Bootstrap CSS -->
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

<!-- Contenido Principal - Kardex de Cursos -->
<div class="container">
    <h3 class="text-center mb-4">Kardex de Cursos</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Curso</th>
                    <th>Estado</th>
                    <th>Fecha Inscripción</th>
                    <th>Última Fecha de Acceso</th>
                    <th>Fecha de Finalización</th>
                    <th>Nivel 1</th>
                    <th>Nivel 2</th>
                    <th>Nivel 3</th>
                    <th>Nivel 4</th>
                    <th>Nivel 5</th>
                    <th>Nivel 6</th>
                    <th>Nivel 7</th>
                    <th>Nivel 8</th>
                    <th>Nivel 9</th>
                </tr>
            </thead>
            <tbody>
                <!-- Curso 1 -->
                <tr>
                    <td>Curso 1</td>
                    <td><span class="badge bg-success">Completo</span></td>
                    <td>01/01/2023</td>
                    <td>15/08/2023</td>
                    <td>20/08/2023</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                </tr>
                <!-- Curso 2 -->
                <tr>
                    <td>Curso 2</td>
                    <td><span class="badge bg-warning">Incompleto</span></td>
                    <td>01/03/2023</td>
                    <td>10/09/2023</td>
                    <td>-</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-warning">En Progreso</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <!-- Curso 3 -->
                <tr>
                    <td>Curso 3</td>
                    <td><span class="badge bg-danger">Incompleto</span></td>
                    <td>01/05/2023</td>
                    <td>01/07/2023</td>
                    <td>-</td>
                    <td><span class="badge bg-danger">Reprobado</span></td>
                    <td><span class="badge bg-danger">Reprobado</span></td>
                    <td><span class="badge bg-warning">En Progreso</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <!-- Curso 4 -->
                <tr>
                    <td>Curso 4</td>
                    <td><span class="badge bg-warning">Incompleto</span></td>
                    <td>01/07/2023</td>
                    <td>15/09/2023</td>
                    <td>-</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                    <td><span class="badge bg-warning">En Progreso</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <!-- Curso 5 -->
                <tr>
                    <td>Curso 5</td>
                    <td><span class="badge bg-warning">Incompleto</span></td>
                    <td>01/09/2023</td>
                    <td>10/09/2023</td>
                    <td>-</td>
                    <td><span class="badge bg-warning">En Progreso</span></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS y dependencias de Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/loadNavBar.js"></script>
<script src="js/kardex.js"></script>

</body>
</html>
