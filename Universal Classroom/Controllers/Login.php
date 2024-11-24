<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/LoginController.php';
$controller = new LoginController();
$controller->login();
?>