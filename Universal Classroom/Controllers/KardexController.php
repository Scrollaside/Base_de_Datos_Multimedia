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

    public function obtenerNiveles($userId) {
        return $this->kardexModel->obtenerNivelesInscritos($userId);
    }

    public function obtenerCursosConDetalles($userId) {
        $cursos = $this->kardexModel->obtenerDetallesCursos($userId);

        foreach ($cursos as &$curso) {
            $niveles = $this->kardexModel->obtenerNivelesPorCurso($curso['curso_id']);
            $curso['niveles'] = [];

            for ($i = 1; $i <= 9; $i++) {
                if (in_array($i, $niveles)) {
                    $nivelId = array_search($i, $niveles) + 1; // Mapeo del número al ID real
                    $curso['niveles'][$i] = $this->kardexModel->obtenerEstadoNivel($userId, $nivelId);
                } else {
                    $curso['niveles'][$i] = 'N/A';
                }
            }
        }

        return $cursos;
    }
}

