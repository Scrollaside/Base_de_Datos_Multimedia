<?php
// Incluir el archivo de configuración
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Models/KardexModel.php';


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
            $nivelesIds = $this->kardexModel->obtenerNivelesPorCurso($curso['curso_id']);
            $curso['niveles'] = [];
    
            foreach ($nivelesIds as $nivelId) {
                $estado = $this->kardexModel->obtenerEstadoNivel($userId, $nivelId);
                $curso['niveles'][] = $estado; // Agregar estados a la lista
            }
    
            // Completar con 'N/A' hasta 9 niveles
            while (count($curso['niveles']) < 9) {
                $curso['niveles'][] = 'N/A';
            }
        }
    
        return $cursos;
    }
    
    
}

