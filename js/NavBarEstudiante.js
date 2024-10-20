window.addEventListener("DOMContentLoaded", function() {
    const navbarContainer = document.createElement('div');
    fetch('NavBarEstudiante.php')
        .then(response => response.text())
        .then(data => {
            navbarContainer.innerHTML = data;
            document.body.insertAdjacentElement('afterbegin', navbarContainer);
        })
        .catch(error => console.error('Error al cargar la barra de navegación:', error));
});
