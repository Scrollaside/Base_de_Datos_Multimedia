<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = new db();
    $db = $conexion->conectar();

    $cursoId = $_POST['cursoId'];
    $niveles = json_decode($_POST['niveles'], true);

    if (!$cursoId || !$niveles) {
        echo json_encode(['success' => false, 'message' => 'Datos insuficientes para insertar niveles.']);
        exit;
    }

    try {
        $db->beginTransaction();

        $query = "INSERT INTO Nivel (Nombre, Descripcion, Video, Documento, LinkRef, CursoID, Costo, Numero)
                  VALUES (:nombre, :descripcion, :video, :documento, :linkRef, :cursoId, :costo, :numero)";

        $stmt = $db->prepare($query);

        foreach ($niveles as $nivel) {
            $stmt->execute([
                ':nombre' => $nivel['titulo'],
                ':descripcion' => $nivel['contenido'],
                ':video' => $nivel['video'],
                ':documento' => $nivel['documento'],
                ':linkRef' => $nivel['link'],
                ':cursoId' => $cursoId,
                ':costo' => $nivel['costo'],
                ':numero' => $nivel['numero'],
            ]);
        }

        $db->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error al insertar niveles: ' . $e->getMessage()]);
    }
}
