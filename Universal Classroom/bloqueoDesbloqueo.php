<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../css/estilosBloqueoDesbloqueo.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>
    <div class="contenedor">
        <h1>Panel de Administración</h1>

        <!-- Buscar Usuarios -->
        <section class="manejo-usuarios">
            <h2>Buscar Usuarios</h2>
            <input type="text" placeholder="Buscar por nombre" id="buscar-usuario">
            <button id="buscar-usuario-btn">Buscar</button>
            
            <!-- Resultados de la Búsqueda -->
            <div class="resultado-usuarios">
                <h3>Resultados:</h3>
                <div id="lista-usuarios"></div>
            </div>
        </section>
    </div>

    <script src="../js/admin.js"></script>
    <script src="js/loadNavBar.js"></script>
</body>
</html>
