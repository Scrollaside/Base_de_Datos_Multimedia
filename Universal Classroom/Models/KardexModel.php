<?php
// Incluir la clase db desde el archivo database.php
require_once __DIR__ . '/../Controllers/database.php';

// KardexModel.php

class KardexModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Consulta para obtener los niveles a los que está inscrito el usuario
    public function obtenerNivelesInscritos($userId) {
        $sql = "SELECT n.ID AS nivel_id, n.Nombre AS nombre_nivel, c.Titulo AS nombre_curso, 
                        i.FechaInscripcion, i.FechaAcceso, i.FechaFinalizacion, i.Estado
                FROM Inscripcion i
                JOIN Nivel n ON i.NivelID = n.ID
                JOIN Curso c ON n.CursoID = c.ID
                WHERE i.UsuarioID = :userId";

        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consulta para obtener los cursos a los que está inscrito el usuario
    public function obtenerCursosInscritos($userId) {
        $sql = "SELECT c.ID AS curso_id, c.Titulo AS nombre_curso, 
                        IF(COUNT(i.NivelID) = c.CantidadNiveles AND 
                           SUM(i.Estado) = COUNT(i.NivelID), 'Terminado', 'En Progreso') AS estado_curso
                FROM Inscripcion i
                JOIN Nivel n ON i.NivelID = n.ID
                JOIN Curso c ON n.CursoID = c.ID
                WHERE i.UsuarioID = :userId
                GROUP BY c.ID";

        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
