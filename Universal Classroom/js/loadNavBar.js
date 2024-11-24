window.addEventListener("DOMContentLoaded", function() {
    const navbarContainer = document.createElement('div');
    let navFile;
    let globalSessionData;  

    
    fetch('./Controllers/sessionData.php')
        .then(response => response.json())
        .then(sessionData => {
            globalSessionData = sessionData;

            if (sessionData.error) {
                navFile = 'NavBarDefault.php';
                console.log("No hay sesión activa, cargando NavBarDefault.php");
            } else {
                console.log("Sesión activa encontrada, cargando NavBar según tipo de usuario");

                // Determinar el NavBar según el TipoUsuario de la sesión
                const typeUsuario = sessionData.TipoUsuario;
                if (typeUsuario == 1) {
                    navFile = 'NavBarEstudiante.php';
                } else if (typeUsuario == 2) {
                    navFile = 'NavBarInstructor.php';
                } else if (typeUsuario == 3) {
                    navFile = 'NavBarAdmin.php';
                } else {
                    navFile = 'NavBarDefault.php';
                }

            }

            // Cargar el archivo de navegación correspondiente
            return fetch(navFile);
        })
        .then(response => response.text())
        .then(data => {
            navbarContainer.innerHTML = data;
            document.body.insertAdjacentElement('afterbegin', navbarContainer);
            console.log("Navbar cargado:", navFile);

            if (!globalSessionData.error) {
                const logoutButton = document.getElementById('loginBTN');
                if (logoutButton) {
                    logoutButton.addEventListener('click', function(event) {
                        event.preventDefault();
                        
                        fetch('./Controllers/logout.php')
                            .then(response => {
                                if (response.ok) {
                                    console.log("Sesión cerrada exitosamente");
                                    window.location.href = "index.php";
                                } else {
                                    console.error("Error al cerrar sesión.");
                                }
                            })
                            .catch(error => console.error('Error al cerrar sesión:', error));
                    });
                }
            }

            // Actualizar el nombre de usuario en la barra de navegación si existe
            if (globalSessionData && globalSessionData.NombreUsuario) {
                const usernameDisplay = document.getElementById('usernameDisplay');
                if (usernameDisplay) {
                    usernameDisplay.textContent = globalSessionData.NombreUsuario;
                    console.log("Nombre de usuario actualizado:", globalSessionData.NombreUsuario);
                } else {
                    console.log("No se encontró el elemento con ID 'usernameDisplay'.");
                }
            }
        })
        .catch(error => console.error('Error al cargar la barra de navegación:', error));
});
