<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/RegistroController.php';
$controller = new RegistroController();
$controller->registrar();
?>