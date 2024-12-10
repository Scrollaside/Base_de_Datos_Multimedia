<?php
require_once '../Models/EstadoModel.php';

class EstadoController {
    private $cursoModel;

    public function __construct() {
        $this->cursoModel = new Curso_Estado();
    }

    public function actualizarEstado($cursoId, $nuevoEstado) {
        if (empty($cursoId) || !isset($nuevoEstado)) {
            return ['success' => false, 'message' => 'Datos incompletos.'];
        }

        $resultado = $this->cursoModel->actualizarEstadoCurso($cursoId, $nuevoEstado);

        if ($resultado) {
            return ['success' => true, 'message' => 'Estado actualizado correctamente.'];
        } else {
            return ['success' => false, 'message' => 'No se pudo actualizar el estado.'];
        }
    }
}

// Manejo de la solicitud AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EstadoController();

    // Decodificar datos JSON del fetch
    $data = json_decode(file_get_contents('php://input'), true);

    $cursoId = $data['cursoId'] ?? null;
    $nuevoEstado = $data['nuevoEstado'] ?? null;

    $respuesta = $controller->actualizarEstado($cursoId, $nuevoEstado);

    echo json_encode($respuesta);
}
