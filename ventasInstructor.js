
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


function filtrarVentas() {
    alert('Filtrando ventas...');
}
