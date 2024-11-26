<?php
// Incluir el archivo de configuración
require_once __DIR__ . '/../config.php';

// Incluir el modelo KardexModel.php
require_once __DIR__ . '/../Models/KardexModel.php';

// KardexController.php

class KardexController {
    private $kardexModel;

    public function __construct($conexion) {
        $this->kardexModel = new KardexModel($conexion);
    }

    // Función para obtener los niveles inscritos
    public function obtenerNiveles($userId) {
        return $this->kardexModel->obtenerNivelesInscritos($userId);
    }

    // Función para obtener los cursos inscritos
    public function obtenerCursos($userId) {
        return $this->kardexModel->obtenerCursosInscritos($userId);
    }
}
?>
