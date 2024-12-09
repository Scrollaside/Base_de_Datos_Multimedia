<?php
require_once '../config.php';
require_once '../Controllers/database.php';
require_once '../Models/EdicionCurso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $cursoId = $data['cursoId'];
    $categorias = $data['categorias']; // Array de IDs de categorías seleccionadas

    $conexion = new db();
    $edicionCurso = new EdicionCurso($conexion);

    try {
        // Eliminar las filas existentes
        $edicionCurso->eliminarCategoriasPorCurso($cursoId);

        // Insertar las nuevas categorías seleccionadas
        foreach ($categorias as $categoriaId) {
            $edicionCurso->insertarCategoriaCurso($cursoId, $categoriaId);
        }

        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
