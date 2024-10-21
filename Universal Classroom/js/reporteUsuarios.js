
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

