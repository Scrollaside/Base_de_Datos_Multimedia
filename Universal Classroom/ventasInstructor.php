<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas del Instructor</title>
    <link rel="stylesheet" href="css/ventasInstructor.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>

    <div id="banner">
        <h1>Reporte de Ventas</h1>
    </div>

    <div class="filters">

        <label for="fecha-inicio">Desde:</label>
        <input type="date" id="fecha-inicio">
        
        <label for="fecha-fin">Hasta:</label>
        <input type="date" id="fecha-fin">
        
        <label for="categoria">Categoría:</label>
        <select id="categoria">
            <option value="todas">Todas</option>
            <!-- <option value="tecnologia">Tecnología</option>
            <option value="programacion">Programación</option>
            <option value="dibujo">Dibujo</option>
            <option value="web">Web</option>
            <option value="videojuegos">VideoJuegos</option>
            <option value="basededatos">Base de Datos</option>
            <option value="marketing">Marketing</option> -->
        </select>

        <label for="estado">Estado del Curso:</label>
        <select id="estado">
            <option value="todos">Todos</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>

        <button onclick="getFiltros()">Filtrar</button>
    </div>


    <div class="toggle-view">
        <button onclick="toggleView()">Ver Detalle por Curso</button>
    </div>


    <div class="ventas-generales" id="ventasGenerales">

        <h1>Resumen General de Cursos</h1><br>

        <table id="tabla-ventas-generales">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Alumnos Inscritos</th>
                    <th>Nivel Promedio</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody >
            </tbody>           
        </table><br><br><br>


        <div id="resumen-forma-pago">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            
        </div>
    </div>

    

    <div class="detalle-ventas" id="detalleVentas" style="display: none;">

        <h1>Detalle de Ventas por Curso</h1><br>

        <label for="cursoSlct">Curso:</label>
        <select id="cursoSlct" onclick = "getCurso()">
        </select>

        <h2 id="NombreCurso"></h2>
        <table id="tabla-detalle-ventas">
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Precio pagado</th>
                    <th>Forma de Pago</th>
                </tr>
            </thead>
            <tbody >
                <!-- <tr>
                    <td>Daniel Uriel Max Moreno Ysiel</td>
                    <td>16-Sep-2024</td>
                    <td>3</td>
                    <td>$1,500.00</td>
                    <td>PayPal</td>
                </tr>
                <tr>
                    <td>Guillermo Javier Morin Tristan</td>
                    <td>04-Jun-2008</td>
                    <td>2</td>
                    <td>$700.00</td>
                    <td>Tarjeta de débito</td>
                </tr>
                <tr>
                    <td>Aldo Rogelio González Zapata</td>
                    <td>08-Jul-2016</td>
                    <td>5</td>
                    <td>$2,100.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>José Jaime De Los Rios Martinez</td>
                    <td>23-Sep-2022</td>
                    <td>7</td>
                    <td>$3,500.00</td>
                    <td>PayPal</td>
                </tr> -->
            </tbody>
        </table><br>

        <div id="resumen-forma-curso">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>Tarjeta de Crédito</td>
                        <td>$300.00</td>
                    </tr>
                    <tr>
                        <td>Tarjeta de débito</td>
                        <td>$3,200.00</td>
                    </tr>
                    <tr>
                        <td>PayPal</td>
                        <td>$5,000.00</td>
                    </tr> -->
                </tbody>
            </table>

            
        </div>
      
    </div>

    <h3 id = "totalingresos">Total Ingresos: </h3><br><br><br>

    
    <script src="js/loadNavBar.js"></script>
    <script src="js/ventasInstructor.js" defer></script>
</body>
</html>
