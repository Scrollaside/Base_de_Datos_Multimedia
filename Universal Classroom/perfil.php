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
$nombreCompleto = $_SESSION['NombreCompleto'];
$nombreUsuario = $_SESSION['NombreUsuario'];
$genero = $_SESSION['Genero'];
$fechaNacimiento = $_SESSION['FechaNacimiento'];
$email = $_SESSION['Email'];
$password = $_SESSION['Contraseña'];

// Obtener la foto de perfil
$usuario = new Usuario();
$fotoPerfil = $usuario->obtenerFotoPorID($usuarioID);
$fotoPerfilSrc = $fotoPerfil ? 'data:image/jpeg;base64,' . base64_encode($fotoPerfil) : 'https://cdn-icons-png.flaticon.com/512/3273/3273898.png';

// Manejo de POST para actualización de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header('Content-Type: application/json');

    $id = $_SESSION['ID'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $genero = $_POST['genero'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    
    // Procesar la nueva foto de perfil si se envió
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['tmp_name']) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    // Actualizar el usuario en la base de datos
    $usuario = new Usuario();
    $resultado = $usuario->actualizarUsuarioPorID($id, $nombreCompleto, $nombreUsuario, $genero, $fechaNacimiento, $email, $contraseña, $foto);

    if ($resultado) {
        // Actualizar datos de sesión
        $_SESSION['NombreCompleto'] = $nombreCompleto;
        $_SESSION['NombreUsuario'] = $nombreUsuario;
        $_SESSION['Genero'] = $genero;
        $_SESSION['FechaNacimiento'] = $fechaNacimiento;
        $_SESSION['Email'] = $email;
        $_SESSION['Contraseña'] = $contraseña;

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo actualizar la información."]);
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>    
    <link rel="stylesheet" href="css/perfil.css">    
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>
    <div class="perfilInfo">
        <div class="FotoPerfil">
            <h1>Perfil de Usuario</h1>
            <!-- Imagen de perfil del usuario -->
            <img src="<?php echo $fotoPerfilSrc; ?>" alt="Foto de perfil" id="profilePic">
            <input type="file" id="NewPhoto" accept="image/*" disabled>
        </div>

        <div class="Informacion">
            <form id="profileForm" data-usuario-id="<?php echo $usuarioID; ?>">
                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" value="<?php echo htmlspecialchars($nombreCompleto); ?>" disabled>

                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" value="<?php echo htmlspecialchars($nombreUsuario); ?>" disabled>

                <label for="gender">Género:</label>
                <select id="gender" disabled>
                    <option value="M" <?php if ($genero === 'M') echo 'selected'; ?>>Masculino</option>
                    <option value="F" <?php if ($genero === 'F') echo 'selected'; ?>>Femenino</option>
                    <option value="O" <?php if ($genero === 'O') echo 'selected'; ?>>Otro</option>
                </select>

                <label for="birth">Fecha de Nacimiento:</label>
                <input type="date" id="birth" value="<?php echo $fechaNacimiento; ?>" disabled>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" disabled>

                <label for="password">Contraseña:</label>
                <input type="text" id="password" value="<?php echo htmlspecialchars($password); ?>" disabled>

                <label for="confirmPassword">Confirmar Contraseña:</label>
                <input type="password" id="confirmPassword" value="<?php echo htmlspecialchars($password); ?>" disabled>

                <div class="buttons">
                    <button type="button" id="editBtn">Editar</button>
                    <button type="button" id="saveBtn" disabled>Guardar</button>
                    <button type="button" id="cancelBtn" disabled>Cancelar</button>
                </div>

                <p id="errorMsg" style="color:green;"></p>
            </form>
        </div>
    </div>

    <script src="js/loadNavBar.js"></script>
    <script src="js/perfil.js"></script>
</body>
</html>
