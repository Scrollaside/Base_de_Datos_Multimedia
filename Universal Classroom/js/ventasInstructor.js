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
    getFiltros();
    mostrarCategorias();
});


function formatFecha(date) {
    const format = date.split('-'); // Divide la fecha 'YYYY-MM-DD'
    return `${format[2]}/${format[1]}/${format[0]}`; // Devuelve 'DD/MM/YYYY'
}

async function getFiltros(){
    const desde = document.getElementById("fecha-inicio").value.trim();
    if (desde === ''){
        localStorage.setItem('desdeF', 'all');   
    }
    else {
        const desdeF = formatFecha(desde);
        localStorage.setItem('desdeF', desdeF);
    }
    const hasta = document.getElementById("fecha-fin").value.trim();
    if (hasta === ''){
        localStorage.setItem('hastaF', 'all');   
    }
    else {
        const hastaF = formatFecha(hasta);
        localStorage.setItem('hastaF', hastaF);
    }
    
    const categoria = document.getElementById("categoria").value.trim();
    localStorage.setItem('categoriaF', categoria);
    const estado = document.getElementById("estado").value.trim();
    localStorage.setItem('estadoF', estado);


    mostrarCursos();
    TablaGeneral();
    TablaPorCurso();
    IngresosGeneral();
}

async function getCurso(){
    const curso = document.getElementById("cursoSlct").value.trim();
    localStorage.setItem('cursoF', curso);
    
    const nombreCurso = document.getElementById('NombreCurso');
    const texto = localStorage.getItem('cursoF');
    nombreCurso.textContent = texto;

    TablaPorCurso();
}

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
    const fechaInicio = localStorage.getItem("desdeF");
    const fechaFin = localStorage.getItem("hastaF");
    const categoria = localStorage.getItem("categoriaF");
    const estado = localStorage.getItem("estadoF");
 

    // if (!instructor) {
    //     console.error("No se encontró el ID del instructor en Local Storage.");
    //     return;
    // }

    formData.append("instructor", instructor);
    formData.append("fechaInicio", fechaInicio);
    formData.append("fechaFin", fechaFin);
    formData.append("categoria", categoria);
    formData.append("estado", estado);
    
    
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
    const fechaInicio = localStorage.getItem("desdeF");
    const fechaFin = localStorage.getItem("hastaF");
    const categoria = localStorage.getItem("categoriaF");
    const estado = localStorage.getItem("estadoF");

    formData.append("instructor", instructor);
    formData.append("fechaInicio", fechaInicio);
    formData.append("fechaFin", fechaFin);
    formData.append("categoria", categoria);
    formData.append("estado", estado);

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
async function TablaPorCurso(){
    const tablaCursos = document.getElementById("tabla-detalle-ventas").getElementsByTagName('tbody')[0];
    const formData = new FormData();
    const instructor = localStorage.getItem("ID");
    const fechaInicio = localStorage.getItem("desdeF");
    const fechaFin = localStorage.getItem("hastaF");
    const categoria = localStorage.getItem("categoriaF");
    const estado = localStorage.getItem("estadoF");
    const curso = localStorage.getItem ("cursoF");

    formData.append("instructor", instructor);
    formData.append("fechaInicio", fechaInicio);
    formData.append("fechaFin", fechaFin);
    formData.append("categoria", categoria);
    formData.append("estado", estado);
    formData.append("curso", curso);

    try {
        const response = await fetch("./Controllers/ReporteVentas.php?accion=VentasPorCurso", {
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

            const alumnoCell = document.createElement("td");
            alumnoCell.textContent = curso.Alumno; // Ajustar a la clave correcta
            row.appendChild(alumnoCell);

            const inscripcionCell = document.createElement("td");
            inscripcionCell.textContent = curso.Inscripcion; // Ajustar a la clave correcta
            row.appendChild(inscripcionCell);

            const nivelCell = document.createElement("td");
            nivelCell.textContent = curso.Nivel; // Ajustar a la clave correcta
            row.appendChild(nivelCell);

            const pagoCell = document.createElement("td");
            pagoCell.textContent = curso.Pago; // Ajustar a la clave correcta
            row.appendChild(pagoCell);

            const formaCell = document.createElement("td");
            if (curso.Forma == 0){
                formaCell.textContent = "Tarjeta"; 
            }
            else if (curso.Forma == 1){
                formaCell.textContent = "PayPal"; 
            }
            row.appendChild(formaCell);

            // Añadir la fila a la tabla
            tablaCursos.appendChild(row);
        });
    } catch (error) {
        console.error("Error en la solicitud Fetch: ", error);
    }
}
async function IngresosGeneral(){
    const tablaCursos = document.getElementById("resumen-forma-pago").getElementsByTagName('tbody')[0];
    const formData = new FormData();
    const instructor = localStorage.getItem("ID");
    const fechaInicio = localStorage.getItem("desdeF");
    const fechaFin = localStorage.getItem("hastaF");
    const categoria = localStorage.getItem("categoriaF");
    const estado = localStorage.getItem("estadoF");

    formData.append("instructor", instructor);
    formData.append("fechaInicio", fechaInicio);
    formData.append("fechaFin", fechaFin);
    formData.append("categoria", categoria);
    formData.append("estado", estado);

    try {
        const response = await fetch("./Controllers/ReporteVentas.php?accion=IngresosGeneral", {
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
        data.data.forEach(forma => {
            const row = document.createElement("tr");
            
            const pagoCell = document.createElement("td");
            if (forma.FormaPago == 0){
                pagoCell.textContent = "Tarjeta"; 
            }
            else if (forma.FormaPago == 1){
                pagoCell.textContent = "PayPal"; 
            }
            row.appendChild(pagoCell);

            const ingresosCell = document.createElement("td");
            ingresosCell.textContent = forma.IngresosTotales;
            row.appendChild(ingresosCell);

            // Añadir la fila a la tabla
            tablaCursos.appendChild(row);
        });
    } catch (error) {
        console.error("Error en la solicitud Fetch: ", error);
    }
}