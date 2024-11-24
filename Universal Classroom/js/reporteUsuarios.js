
function toggleView() {
    const reporteInstructores = document.getElementById('reporteInstructores');
    const reporteEstudiantes = document.getElementById('reporteEstudiantes');
    const toggleButton = document.querySelector('.toggle-view button');

    if (reporteInstructores.style.display === 'none') {
        reporteInstructores.style.display = 'block';
        reporteEstudiantes.style.display = 'none';
        toggleButton.textContent = 'Reporte de Estudiantes';
    } else {
        reporteInstructores.style.display = 'none';
        reporteEstudiantes.style.display = 'block';
        toggleButton.textContent = 'Reporte de Instructores';
    }
}


class Report {
    constructor(Usuario, Nombre) {
        this.Usuario = Usuario;
        this.Nombre = Nombre;
       
    }

    get descripcion() {
        let row = document.createElement("tr");
        row.innerHTML = `    
          <tr>
              <td>${this.Usuario}</td>
              <td>${this.Nombre}</td>
            
          </tr>   
      `;
        return row;
    }
}

let tableBody = document.getElementById("tabla-reporte");
let userdata = []; 

function listarUsuarios() {
    tableBody.innerHTML = "";
    // console.log(playerdataTT);
    userdata.forEach((userdata) => {
        tableBody.appendChild(userdata.descripcion);
    });
}


async function obtenerDB() {
    {
        let response = await fetch("./Controllers/Reporte.php");
        // if (!response.ok) {
        //     throw new Error(`HTTP error! Status: ${response.status}`);
        // }

        let responseJSON = await response.json();
        console.log(responseJSON)

        // Procesar datos del modo historia
        if (responseJSON.storyMode && Array.isArray(responseJSON.storyMode)) {
            responseJSON.storyMode.forEach((r) => {
                let newUserData = new Report(r.Usuario, r.Nombre);
                userdata.push(newUserData);
            });
            listarUsuarios(); // Listar jugadores en la tabla de historia
        }

        // Procesar datos del modo contrarreloj
        if (responseJSON.timeTrial && Array.isArray(responseJSON.timeTrial)) {
            responseJSON.timeTrial.forEach((p) => {
                let newPlayerData = new TimeTrial(p.Posicion, p.Jugador, p.Tiempo);
                playerdataTT.push(newPlayerData);
            });
            listarJugadoresTT(); // Listar jugadores en la tabla de contrarreloj
        }
    } 
}




obtenerDB();


// document.addEventListener("DOMContentLoaded", function () {
//     const userId = localStorage.getItem("ID_Usuario");

//     if (userId) {
//         fetch('Controllers/Reporte.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ ID: userId })
//         })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     document.getElementById('name').value = data.NombreCompleto;
//                     document.getElementById('username').value = data.NombreUsuario;

//                     // Ajustar el género basado en la letra
//                     document.getElementById('gender').value = (data.Genero === 'm') ? 'masculino' : 'femenino';

//                     document.getElementById('birth').value = data.FechaNacimiento;
//                     document.getElementById('email').value = data.Email;
//                     document.getElementById('password').value = data.Contraseña; // Asigna la contraseña
//                     document.getElementById('confirmPassword').value = data.Contraseña; // Asigna la contraseña a confirmPassword
//                 }
//                 else {
//                     console.error(data.error);
//                     document.getElementById('errorMsg').textContent = data.error;
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 document.getElementById('errorMsg').textContent = "Error al cargar la información del usuario.";
//             });
//     } else {
//         console.error("No hay ID de usuario en Local Storage.");
//         document.getElementById('errorMsg').textContent = "No hay usuario logueado.";
//     }
// });
