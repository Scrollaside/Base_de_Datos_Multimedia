<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link rel="stylesheet" href="css/reporteUsuarios.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>

    <div id="banner">
        <h1>Reporte de Usuarios</h1>
    </div>
<form method="POST" >
    <div class="toggle-view" >
        <button onclick="toggleView()" id = "reporteToggle" action="Controllers/Reporte.php" >Reporte de Estudiantes</button>
    </div>
</FORM>

    <div class="reporteInstructores" id="reporteInstructores">

        <h1>Reporte de Instructores</h1>

        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Fecha de ingreso</th>
                    <th>Cantidad de cursos ofrecidos</th>
                    <th>Total de ganancias</th>
                </tr>
            </thead>
            <tbody id="tabla-ventas-generales">
                <tr>
                    <td>Benny</td>
                    <td>Brenda Ovalle Torre</td>
                    <td>12 oct 2021</td>
                    <td>4</td>
                    <td>$10,500.00</td>
                </tr>
                <tr>
                    <td>Idaly</td>
                    <td>Idali Baltazar Cruz</td>
                    <td>10 sep 2014</td>
                    <td>1</td>
                    <td>$700.00</td>
                </tr>
                <tr>
                    <td>Angely</td>
                    <td>Angeles Daniela Ramirez Alvarez</td>
                    <td>15 ago 2024</td>
                    <td>7</td>
                    <td>$14,700.00</td>
                </tr>
                <tr>
                    <td>Villy</td>
                    <td>Juan Alejandro Villarreal Mojica</td>
                    <td>31 mar 2008</td>
                    <td>12</td>
                    <td>$12,000.00</td>
                </tr>
            </tbody>           
        </table>

    </div>



    <div class="reporteEstudiantes" id="reporteEstudiantes" style="display: none;">

        <h1>Reporte de Estudiantes</h1>


        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Fecha de ingreso</th>
                    <th>Cantidad de cursos inscritos</th>
                    <th>Cursos terminados (%)</th>
                </tr>
            </thead>
            <tbody id="tabla-detalle-ventas">
                <tr>
                    <td>Dummy</td>
                    <td>Daniel Uriel Max Moreno Ysiel</td>
                    <td>14 sep 2020</td>
                    <td>20</td>
                    <td>40</td>
                </tr>     
                <tr>
                    <td>Memorandum04</td>
                    <td>Guillermo Javier Morin Tristan</td>
                    <td>04 jun 2023</td>
                    <td>7</td>
                    <td>46</td>
                </tr>     
                <tr>
                    <td>Roger</td>
                    <td>Aldo Rogelio Gonzalez Zapata</td>
                    <td>6 jun 2018</td>
                    <td>15</td>
                    <td>75</td>
                </tr>     
                <tr>
                    <td>DANY</td>
                    <td>Daniel Uriel Max Moreno Ysiel</td>
                    <td>21 ene 2012</td>
                    <td>9</td>
                    <td>60</td>
                </tr>     
                <tr>
                    <td>Josr De</td>
                    <td>José Jaime De Los Rios Martinez</td>
                    <td>23 sep 2021</td>
                    <td>12</td>
                    <td>55</td>
                </tr>     
                <tr>
                    <td>Kezan</td>
                    <td>Alberto Kezan Guardiola Ayala</td>
                    <td>21 may 2019</td>
                    <td>16</td>
                    <td>80</td>
                </tr>                
            </tbody>
        </table>
    </div>

    <script src="js/reporteUsuarios.js"></script>
    <script src="js/loadNavBar.js"></script>

</body>
</html>
<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     const userId = localStorage.getItem("ID_Usuario");

    //     if (userId) {
    //         fetch('Controllers/getUserProfile.php', {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify({ ID: userId })
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 document.getElementById('name').value = data.NombreCompleto;
    //                 document.getElementById('username').value = data.NombreUsuario;

    //                 // Ajustar el género basado en la letra
    //                 document.getElementById('gender').value = (data.Genero === 'm') ? 'masculino' : 'femenino';

    //                 document.getElementById('birth').value = data.FechaNacimiento;
    //                 document.getElementById('email').value = data.Email;
    //                 document.getElementById('password').value = data.Contraseña; // Asigna la contraseña
    //                 document.getElementById('confirmPassword').value = data.Contraseña; // Asigna la contraseña a confirmPassword
    //             } 
    //             else {
    //                 console.error(data.error);
    //                 document.getElementById('errorMsg').textContent = data.error;
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             document.getElementById('errorMsg').textContent = "Error al cargar la información del usuario.";
    //         });
    //     } else {
    //         console.error("No hay ID de usuario en Local Storage.");
    //         document.getElementById('errorMsg').textContent = "No hay usuario logueado.";
    //     }
    // });
</script>