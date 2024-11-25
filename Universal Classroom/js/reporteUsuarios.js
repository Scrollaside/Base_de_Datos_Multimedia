let Table = "tabla-instructores";
function toggleView() {
    const reporteInstructores = document.getElementById('reporteInstructores');
    const reporteEstudiantes = document.getElementById('reporteEstudiantes');
    const toggleButton = document.querySelector('.toggle-view button');

    if (reporteInstructores.style.display === 'none') {
        reporteInstructores.style.display = 'block';
        reporteEstudiantes.style.display = 'none';
        toggleButton.textContent = 'Reporte de Estudiantes';
        Table = "tabla-instructores";
       // const userType = localStorage.setItem('Type', 1);

    } else {
        reporteInstructores.style.display = 'none';
        reporteEstudiantes.style.display = 'block';
        toggleButton.textContent = 'Reporte de Instructores';
        Table = "tabla-estudiantes";
        //const userType = localStorage.setItem('Type', 2);
    }
}

class Report {
    constructor(usuario, nombre, ingreso, cursos, total) {
        this.Usuario = usuario;
        this.Nombre = nombre;
        this.Ingreso = ingreso;
        this.Cursos = cursos;
        this.Total = total; // Puede ser ganancias o porcentaje
    }

    get descripcion() {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${this.Usuario}</td>
            <td>${this.Nombre}</td>
            <td>${this.Ingreso}</td>
            <td>${this.Cursos}</td>
            <td>${this.Total}</td>
        `;
        return row;
    }
}

function getTableBody() {
    return document.getElementById(Table);
}
let userdata = [];

function listarUsuarios() {
    const tableBody = getTableBody();
    tableBody.innerHTML = "";
    userdata.forEach((user) => {
        tableBody.appendChild(user.descripcion);
    });
}

async function obtenerDB() {
    // try {
        let response = await fetch("./Controllers/Reporte.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ reporteToggle: document.getElementById("reporteToggle").textContent }),
        });
      //  const userType = localStorage.setItem('Text', document.getElementById("reporteToggle").textContent)
        let responseJSON = await response.json();
        userdata = []; // Limpia datos anteriores

        if (Array.isArray(responseJSON)) {
            responseJSON.forEach((r) => {
                let newUser = new Report(
                    r.Usuario,
                    r.Nombre,
                    r.Ingreso,
                    r.Cursos,
                    r.Total 
                );
                userdata.push(newUser);
            });
            listarUsuarios();
        } else {
            console.error(responseJSON.error || "Error desconocido.");
        }
    // } catch (error) {
    //     console.error("Error al obtener datos:", error);
    // }
}

document.getElementById("reporteToggle").addEventListener("click", obtenerDB);


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
