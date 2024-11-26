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
    <title>Administración de Categorías</title>
    <link rel="stylesheet" href="css/categorias.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>

    <h1 id="banner">Administración de Categorías</h1>

    <form id="formCategorias">
        <label for="nombreCategoria">Nombre de la Categoría:</label>
        <input type="text" id="nombreCategoria" required>
        <br>

        <label for="descripcionCategoria">Descripción:</label>
        <textarea id="descripcionCategoria" required></textarea>
        <br>

        <label for="adminName">Administrador:</label>
        <input type="text" id="adminName" value="" disabled></input>
        <br>

        <button type="button" onclick="guardarCategoria()">Agregar/Guardar Categoría</button>
    </form><br><br>

    <h2>Lista de Categorías</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Usuario Creador</th>
                <th>Fecha de Creación</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="tablaCategorias">
            
        </tbody>
    </table>

    <script src="js/categorias.js"></script>
    <script src="js/loadNavBar.js"></script>

</body>
</html>
