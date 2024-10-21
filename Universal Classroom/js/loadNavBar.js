window.addEventListener("DOMContentLoaded", function() {
    const navbarContainer = document.createElement('div');
    let typeUsuario = localStorage.getItem('Type_Usuario'); 
    let navFile;

    // Determinar el NavBar según el valor de Type_Usuario
    if (typeUsuario === '1') {
        navFile = 'NavBarEstudiante.php';
    } else if (typeUsuario === '2') {
        navFile = 'NavBarInstructor.php';
    } else if (typeUsuario === '3') {
        navFile = 'NavBarAdmin.php';
    } else {
        navFile = 'NavBarDefault.php'; 
    }

    fetch(navFile)
        .then(response => response.text())
        .then(data => {
            navbarContainer.innerHTML = data;
            document.body.insertAdjacentElement('afterbegin', navbarContainer);

            
            if (navFile !== 'NavBarDefault.php') {

                const logoutButton = document.getElementById('loginBTN');

                if (logoutButton) {
                    logoutButton.addEventListener('click', function(event) {
                        event.preventDefault(); 
                        
                        localStorage.removeItem('ID_Usuario');
                        localStorage.removeItem('Nombre_Usuario');
                        localStorage.removeItem('Type_Usuario');

                        window.location.href = 'index.php';
                    });
                }
            }
        })
        .catch(error => console.error('Error al cargar la barra de navegación:', error));
});
