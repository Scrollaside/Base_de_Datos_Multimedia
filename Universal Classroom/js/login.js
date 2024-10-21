document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    // Realizar la solicitud AJAX al servidor
    fetch('Controllers/LoginController.php', {
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
            localStorage.setItem("ID_Usuario", data.ID_Usuario);
            localStorage.setItem("Nombre_Usuario", data.Nombre_Usuario);
            localStorage.setItem("Type_Usuario", data.Type_Usuario);

            // Redirigir según el tipo de usuario
            if (data.Type_Usuario === 1) {
                window.location.href = "index.php";
            } else if (data.Type_Usuario === 2) {
                window.location.href = "instructor.php";
            } else if (data.Type_Usuario === 3) {
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
