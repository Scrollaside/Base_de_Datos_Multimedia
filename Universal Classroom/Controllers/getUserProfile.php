<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/UserProfileController.php';

$controller = new UserProfileController();
$controller->obtenerPerfil();
?>
