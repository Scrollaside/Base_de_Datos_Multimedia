document.getElementById("buscar-usuario-btn").addEventListener("click", function() {
    const buscador = document.getElementById("buscar-usuario").value.toLowerCase();
    const usuarios = [
        { nombre: "Juan Pérez", id: 1, bloqueado: false },
        { nombre: "María López", id: 2, bloqueado: true },
        { nombre: "Carlos Gómez", id: 3, bloqueado: false },
        { nombre: "Ana Rodríguez", id: 4, bloqueado: true },
    ];

    // Filtrar usuarios por nombre similar al buscado
    const usuariosFiltrados = usuarios.filter(usu => usu.nombre.toLowerCase().includes(buscador));

    // Limpiar la lista de resultados
    const listaUsuarios = document.getElementById("lista-usuarios");
    listaUsuarios.innerHTML = "";

    // Mostrar resultados
    usuariosFiltrados.forEach(usu => {
        const tarjetaUsuario = document.createElement("div");
        tarjetaUsuario.className = "tarjeta-usuario";

        const nombreUsuario = document.createElement("span");
        nombreUsuario.textContent = usu.nombre;

        const botonBD = document.createElement("button");
        botonBD.textContent = usu.bloqueado ? "Desbloquear" : "Bloquear";
        botonBD.className = usu.bloqueado ? "unblock" : "block";
        botonBD.addEventListener("click", function() {
            // Simulación de acción de bloquear/desbloquear
            if (usu.bloqueado) {
                alert(`Usuario ${usu.nombre} desbloqueado.`);
            } else {
                alert(`Usuario ${usu.nombre} bloqueado.`);
            }
            usu.bloqueado = !usu.bloqueado;
            botonBD.textContent = usu.bloqueado ? "Desbloquear" : "Bloquear";
            botonBD.className = usu.bloqueado ? "unblock" : "block";
        });

        tarjetaUsuario.appendChild(nombreUsuario);
        tarjetaUsuario.appendChild(botonBD);
        listaUsuarios.appendChild(tarjetaUsuario);
    });

    if (usuariosFiltrados.length === 0) {
        listaUsuarios.textContent = "No se encontraron usuarios.";
    }
});
