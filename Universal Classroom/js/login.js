document.getElementById("btn").addEventListener('click', function(event) {
    event.preventDefault();
    
    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    // Realizar la solicitud AJAX al servidor
    fetch('./Controllers/Login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ usuario, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
        
            // Mostrar un mensaje pop-up
            alert("Inicio de Sesión exitoso.");
        
            // Redirigir según el tipo de usuario
            if (data.TipoUsuario == 1) {
                window.location.href = "index.php";
            } else if (data.TipoUsuario == 2) {
                window.location.href = "instructor.php";
            } else if (data.TipoUsuario == 3) {
                window.location.href = "bloqueoDesbloqueo.php";
            }
            localStorage.setItem("ID", data.ID);
            localStorage.setItem("TipoUsuario", data.TipoUsuario);

        } else {
            // Mostrar mensaje de error
            document.getElementById("errorMsg").textContent = data.error;
        }
    })
});
