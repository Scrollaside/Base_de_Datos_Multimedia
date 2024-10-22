document.getElementById("btn").addEventListener('click', function(event) {
    event.preventDefault();
    
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    // Realizar la solicitud AJAX al servidor
    fetch('Controllers/Login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ usuario, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Guardar en Local Storage
            localStorage.setItem("ID_Usuario", data.ID);
            localStorage.setItem("Nombre_Usuario", data.Nombre_Usuario);
            localStorage.setItem("Type_Usuario", data.TipoUsuario);

            // Redirigir según el tipo de usuario
            if (data.TipoUsuario === 1) {
                window.location.href = "index.php";
            } else if (data.TipoUsuario === 2) {
                window.location.href = "instructor.php";
            } else if (data.TipoUsuario === 3) {
                window.location.href = "bloqueoDesbloqueo.php";
            }
        } else {
            // Mostrar mensaje de error
            document.getElementById("errorMsg").textContent = data.error;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("errorMsg").textContent = "Ha ocurrido un error al procesar la solicitud.";
    });
});
