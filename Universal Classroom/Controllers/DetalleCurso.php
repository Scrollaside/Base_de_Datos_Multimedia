<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once 'DetalleCursoController.php';
$controller = new CursoController();
$controller->traerDatos();
?>