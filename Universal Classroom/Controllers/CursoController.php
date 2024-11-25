<?php
require_once '../config.php';
require_once PROJECT_ROOT . '/Models/Curso.php';

class CursoController {
    public function verDetalles($id) {
        $cursoModel = new Curso();
        $curso = $cursoModel->obtenerCursoPorId($id);
        if ($curso) {
            require_once PROJECT_ROOT . '/views/detalleCurso.php';
        } else {
            echo "Curso no encontrado.";
        }
    }
}

// Capturando el ID del curso desde la URL o formulario
if (isset($_GET['id'])) {
    $cursoController = new CursoController();
    $cursoController->verDetalles($_GET['id']);
} else {
    echo "ID del curso no proporcionado.";
}
