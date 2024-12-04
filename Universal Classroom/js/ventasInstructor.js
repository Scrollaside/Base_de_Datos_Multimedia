// window.addEventListener("DOMContentLoaded", function () {

//     fetch('./Controllers/ReporteController.php', {
//         method: "POST",
//         body: JSON.stringify({ option: 2 })
//       }).then(response => response.json())
//         .then(data => {
//           if (data.success) {
//            console.log(data);
//           }else{
//             alert('No hay nada');
//           }
//         })
//         .catch(error => {
//           alert("Error de red: " + error.message);
//         }); 
// });

function toggleView() {
    const ventasGenerales = document.getElementById('ventasGenerales');
    const detalleVentas = document.getElementById('detalleVentas');
    const toggleButton = document.querySelector('.toggle-view button');

    if (ventasGenerales.style.display === 'none') {
        ventasGenerales.style.display = 'block';
        detalleVentas.style.display = 'none';
        toggleButton.textContent = 'Ver Detalle por Curso';
    } else {
        ventasGenerales.style.display = 'none';
        detalleVentas.style.display = 'block';
        toggleButton.textContent = 'Ver Resumen General';
    }
}

document.addEventListener("DOMContentLoaded", () => {
   // const instructor = localStorage.getItem("ID");;
    mostrarCategorias();
    mostrarCursos();
    TablaGeneral();
});

async function mostrarCategorias(){

    const selectCategoria = document.getElementById("categoria");

    fetch("./Controllers/CategoriaL.php")
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error desde el servidor: ", data.error);
                return;
            }
  
            // Llenar el select con los datos de la base de datos.
            data.forEach(categoria => {
                const option = document.createElement("option");
                //option.value = curso.ID; // ID del curso
                option.textContent = categoria.Nombre; // Nombre del curso
                selectCategoria.appendChild(option);
            });
        })
        .catch(error => console.error("Error en la solicitud Fetch: ", error));
}

async function mostrarCursos() {
    const selectCurso = document.getElementById("cursoSlct");
    const formData = new FormData();
    const instructor = localStorage.getItem("ID");

    if (!instructor) {
        console.error("No se encontró el ID del instructor en Local Storage.");
        return;
    }

    formData.append("instructor", instructor);
    try {
        const response = await fetch("./Controllers/ReporteVentas.php?accion=VentasGeneral", {
            method: "POST", // Cambiamos a POST para enviar datos en el cuerpo
            body: formData,
        });

        const data = await response.json();

        if (data.success === false) {
            console.error("Error desde el servidor: ", data.message);
            return;
        }
        selectCurso.innerHTML = '';
        // Llenar el select con los datos de la base de datos.
        data.data.forEach(curso => {
            const option = document.createElement("option");
            option.value = curso.Curso; // Ajustar a la clave correcta (si no es `ID`)
            option.textContent = curso.Curso; // Ajustar a la clave correcta (si no es `Nombre`)
            selectCurso.appendChild(option);
        });
    } catch (error) {
        console.error("Error en la solicitud Fetch: ", error);
    }
}

async function TablaGeneral(){
    const tablaCursos = document.getElementById("tabla-ventas-generales").getElementsByTagName('tbody')[0];
    const formData = new FormData();
    const instructor = localStorage.getItem("ID");

    if (!instructor) {
        console.error("No se encontró el ID del instructor en Local Storage.");
        return;
    }

    formData.append("instructor", instructor);

    try {
        const response = await fetch("./Controllers/ReporteVentas.php?accion=VentasGeneral", {
            method: "POST", // Cambiamos a POST para enviar datos en el cuerpo
            body: formData,
        });

        const data = await response.json();

        if (!data.success) {
            console.error("Error desde el servidor: ", data.message);
            return;
        }

        // Vaciar el cuerpo de la tabla antes de llenarla
        tablaCursos.innerHTML = '';

        // Llenar la tabla con los datos recibidos
        data.data.forEach(curso => {
            const row = document.createElement("tr");

            const cursoCell = document.createElement("td");
            cursoCell.textContent = curso.Curso; // Ajustar a la clave correcta
            row.appendChild(cursoCell);

            const alumnosCell = document.createElement("td");
            alumnosCell.textContent = curso.Alumnos; // Ajustar a la clave correcta
            row.appendChild(alumnosCell);

            const promedioCell = document.createElement("td");
            promedioCell.textContent = curso.Promedio; // Ajustar a la clave correcta
            row.appendChild(promedioCell);

            const ingresosCell = document.createElement("td");
            ingresosCell.textContent = curso.Ingresos; // Ajustar a la clave correcta
            row.appendChild(ingresosCell);

            // Añadir la fila a la tabla
            tablaCursos.appendChild(row);
        });
    } catch (error) {
        console.error("Error en la solicitud Fetch: ", error);
    }
}