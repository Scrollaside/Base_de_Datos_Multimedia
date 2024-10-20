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


    <div class="toggle-view">
        <button onclick="toggleView()">Ver Detalle por Curso</button>
    </div>


    <div class="ventas-generales" id="ventasGenerales">

        <h1>Resumen General de Cursos</h1><br>

        <table>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Alumnos Inscritos</th>
                    <th>Nivel Promedio</th>
                    <th>Ingresos</th>
                </tr>
            </thead>
            <tbody id="tabla-ventas-generales">
                <tr>
                    <td>Curso de Programación</td>
                    <td>120</td>
                    <td>3</td>
                    <td>$10,500.00</td>
                </tr>
                <tr>
                    <td>Todo sobre Unreal Engine</td>
                    <td>873</td>
                    <td>7</td>
                    <td>$63,700.00</td>
                </tr>
                <tr>
                    <td>Curso de HTML</td>
                    <td>350</td>
                    <td>10</td>
                    <td>$17,000.00</td>
                </tr>
                <tr>
                    <td>Curso de C#</td>
                    <td>72</td>
                    <td>2</td>
                    <td>$2,500.00</td>
                </tr>
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
                    <tr>
                        <td>Tarjeta de Crédito</td>
                        <td>$19,300.00</td>
                    </tr>
                    <tr>
                        <td>Tarjeta de débito</td>
                        <td>$11,600.00</td>
                    </tr>
                    <tr>
                        <td>PayPal</td>
                        <td>$62,800.00</td>
                    </tr>
                </tbody>
            </table>

            <h3>Total Ingresos: $93,700.00</h3>
        </div>
    </div>



    <div class="detalle-ventas" id="detalleVentas" style="display: none;">

        <h1>Detalle de Ventas por Curso</h1><br>

        <h2>Curso de Programación</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Precio pagado</th>
                    <th>Forma de Pago</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-ventas">
                <tr>
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
                </tr>
            </tbody>
        </table><br>

        <div id="resumen-forma-pago">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                    </tr>
                </tbody>
            </table>

            <h3>Total Ingresos: $10,500.00</h3><br><br><br>
        </div>



        <h2>Todo sobre Unreal Engine</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Precio pagado</th>
                    <th>Forma de Pago</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-ventas">
                <tr>
                    <td>Guillermo Javier Morin Tristan</td>
                    <td>07-Feb-2023</td>
                    <td>8</td>
                    <td>$5,600.00</td>
                    <td>Tarjeta de débito</td>
                </tr>
                <tr>
                    <td>Max Osvaldo de León Cantú</td>
                    <td>20-Ago-2020</td>
                    <td>3</td>
                    <td>$1,100.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>Aldo Rogelio González Zapata</td>
                    <td>17-Abr-2019</td>
                    <td>5</td>
                    <td>$2,400.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
            </tbody>
        </table><br>
        
        <div id="resumen-forma-pago">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tarjeta de Crédito</td>
                        <td>$59,000.00</td>
                    </tr>
                    <tr>
                        <td>Tarjeta de débito</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td>PayPal</td>
                        <td>$4,500.00</td>
                    </tr>
                </tbody>
            </table>

            <h3>Total Ingresos: $63,700.00</h3><br><br><br>
        </div>
        



        <h2>Curso de HTML</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Precio pagado</th>
                    <th>Forma de Pago</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-ventas">
                <tr>
                    <td>Alberto Kezan Guardiola Ayala</td>
                    <td>21-Dic-2018</td>
                    <td>4</td>
                    <td>$4,200.00</td>
                    <td>Tarjeta de débito</td>
                </tr>
                <tr>
                    <td>Max Osvaldo de León Cantú</td>
                    <td>13-Ene-2019</td>
                    <td>1</td>
                    <td>$500.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>Daniel Uriel Max Moreno Ysiel</td>
                    <td>30-Feb-2014</td>
                    <td>8</td>
                    <td>$4,350.00</td>
                    <td>PayPal</td>
                </tr>
            </tbody>
        </table><br>

        <div id="resumen-forma-pago">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tarjeta de Crédito</td>
                        <td>$300.00</td>
                    </tr>
                    <tr>
                        <td>Tarjeta de débito</td>
                        <td>$3,700.00</td>
                    </tr>
                    <tr>
                        <td>PayPal</td>
                        <td>$13,000.00</td>
                    </tr>
                </tbody>
            </table>

            <h3>Total Ingresos: $17,000.00</h3><br><br><br>
        </div>



        <h2>Curso de C#</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Fecha de Inscripción</th>
                    <th>Nivel de Avance</th>
                    <th>Precio pagado</th>
                    <th>Forma de Pago</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-ventas">
                <tr>
                    <td>Alberto Kezan Guardiola Ayala</td>
                    <td>12-Feb-2024</td>
                    <td>3</td>
                    <td>$200.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>Max Osvaldo de León Cantú</td>
                    <td>01-Dic-2021</td>
                    <td>3</td>
                    <td>$400.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>Daniel Uriel Max Moreno Ysiel</td>
                    <td>02-Mar-2017</td>
                    <td>4</td>
                    <td>$350.00</td>
                    <td>Tarjeta de crédito</td>
                </tr>
                <tr>
                    <td>Guillermo Javier Morin Tristan</td>
                    <td>06-Abr-2016</td>
                    <td>7</td>
                    <td>$200.00</td>
                    <td>Paypal</td>
                </tr>
                <tr>
                    <td>Aldo Rogelio González Zapata</td>
                    <td>23-Sep-2020</td>
                    <td>5</td>
                    <td>$850.00</td>
                    <td>Tarjeta de débito</td>
                </tr>
            </tbody>
        </table><br>

        <div id="resumen-forma-pago">

            <table>
                <thead>
                    <tr>
                        <th>Forma de Pago</th>
                        <th>Ingresos Totales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tarjeta de Crédito</td>
                        <td>$1,500.00</td>
                    </tr>
                    <tr>
                        <td>Tarjeta de débito</td>
                        <td>$1,000.00</td>
                    </tr>
                    <tr>
                        <td>PayPal</td>
                        <td>$0.00</td>
                    </tr>
                </tbody>
            </table>

            <h3>Total Ingresos: $2,500.00</h3><br><br><br>
        </div>

    </div>

    <script src="js/ventasInstructor.js"></script>
    <script src="js/loadNavBar.js"></script>
</body>
</html>
