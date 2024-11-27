<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once 'MensajeController.php';
$controller = new MensajeController();
$controller->traerDatos();
?>