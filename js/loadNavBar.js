window.addEventListener("DOMContentLoaded", function() {
    const navbarContainer = document.createElement('div');
    let typeUsuario = localStorage.getItem('Type_Usuario'); 
    let navFile;


    // Determinar el archivo de navegación según el valor de Type_Usuario
    if (typeUsuario === '1') {
        navFile = 'NavBarEstudiante.html';
    } else if (typeUsuario === '2') {
        navFile = 'NavBarInstructor.html';
    } else if (typeUsuario === '3') {
        navFile = 'NavBarAdmin.html';
    } else {
        navFile = 'NavBarDefault.html'; 
    }

    fetch(navFile)
        .then(response => response.text())
        .then(data => {
            navbarContainer.innerHTML = data;
            document.body.insertAdjacentElement('afterbegin', navbarContainer);
        })
        .catch(error => console.error('Error al cargar la barra de navegación:', error));
});
