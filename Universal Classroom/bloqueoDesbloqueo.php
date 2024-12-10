<?php
session_start();
require_once __DIR__ . '/config.php';
require_once PROJECT_ROOT . '/Models/Usuario.php';

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['ID'])) {
    echo "<p>No hay usuario logueado.</p>";
    exit;
}

// Cargar la información del usuario desde la sesión
$usuarioID = $_SESSION['ID'];


// // Obtener la foto de perfil
// $usuario = new Usuario();
// $fotoPerfil = $usuario->obtenerFotoPorID($usuarioID);
// $fotoPerfilSrc = $fotoPerfil ? 'data:image/jpeg;base64,' . base64_encode($fotoPerfil) : 'https://cdn-icons-png.flaticon.com/512/3273/3273898.png';

// Manejo de POST para actualización de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header('Content-Type: application/json');

    $id = $_SESSION['ID'];
}



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>
    <div class="contenedor-usuarios">
        <h1>Panel de Administración</h1>

        <section class="manejo-usuarios">
            <form onsubmit="searchUsers(event)">

                <h2>Buscar Usuarios</h2>
                <div class="search">
                    <input type="text" placeholder="Buscar por nombre" id="buscar-usuario">
                    <button id="buscar-usuario-btn">Buscar</button>
                </div>
            </form>
            <div class="cards">

                <div class="card total-users-card">
                    <span class="title">
                        Resumen
                    </span>

                    <div class="content">
                        <span id="total-count" class="number">
                            0
                        </span>

                        <span class="subtitle">
                            Total
                        </span>
                    </div>
                </div>

                <div class="card active-users-card">
                    <span class="title">
                        Resumen
                    </span>

                    <div class="content">
                        <span id="active-count" class="number">
                            0
                        </span>

                        <span  class="subtitle">
                            Activos
                        </span>
                    </div>
                </div>

                <div class="card inactive-users-card">
                    <span class="title">
                        Resumen
                    </span>

                    <div class="content">
                        <span id="inactive-count" class="number">
                            0
                        </span>

                        <span class="subtitle">
                            Inactivos
                        </span>
                    </div>
                </div>


            </div>

            <!-- Buscar Usuarios -->


            <!-- Resultados de la Búsqueda -->
            <div class="resultado-usuarios">
                <h3>Resultados:</h3>
                <div id="lista-usuarios"></div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="table">

                </tbody>
            </table>
        </section>
    </div>

    <script src="js/loadNavBar.js"></script>
    <script src="js/usuarios.js"></script>
</body>

</html>