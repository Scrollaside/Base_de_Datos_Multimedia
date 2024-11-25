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

    <div class="toggle-view" >
        <button onclick="toggleView()" id = "reporteToggle" action="Controllers/Reporte.php" >Reporte de Estudiantes</button>
    </div>


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
            <tbody id="tabla-instructores">
                
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
            <tbody id="tabla-estudiantes">
             
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