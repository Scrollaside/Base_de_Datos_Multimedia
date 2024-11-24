<?php
session_start();
require_once __DIR__ . '/config.php';
require_once PROJECT_ROOT . '/Models/Usuario.php';

// Verificar si hay sesión activa y si el ID del usuario está disponible
$fotoPerfilSrc = 'img/dummy.png'; // Imagen de perfil predeterminada

if (isset($_SESSION['ID'])) {
    $usuarioID = $_SESSION['ID'];
    $usuario = new Usuario();
    $foto = $usuario->obtenerFotoPorID($usuarioID);

    if ($foto) {
        // Convertir la foto en un formato que pueda ser usado en el <img> (Base64)
        $fotoPerfilSrc = 'data:image/jpeg;base64,' . base64_encode($foto);
    }
}
?>

<div class="navbar-container">
    <div class="profile">
        <a href="perfil.php">
            <img src="<?php echo $fotoPerfilSrc; ?>" alt="Foto de Perfil" class="profile-pic">
        </a>

        <span class="username" id="usernameDisplay">
            <?php echo $_SESSION['NombreUsuario'] ?? 'Usuario'; ?>
        </span>
    </div>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="Busqueda.php">Buscador</a></li>
            <li><a href="Kardex.php">Kárdex</a></li>
            <li><a href="certificado.php">Diplomas</a></li>
            <a href="index.php" id="loginBTN"><button>Cerrar Sesión</button></a>
        </ul>
    </nav>
</div>
