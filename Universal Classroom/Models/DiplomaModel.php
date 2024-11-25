<?php
// Archivo: Models/DiplomaModel.php

class DiplomaModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                'mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset,
                db_user,
                db_pass
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function obtenerDiplomasPorUsuario($usuarioID) {
        $sql = "
            SELECT d.FechaFin, u.NombreCompleto AS NombreEstudiante, i.NombreCompleto AS NombreInstructor, c.Titulo AS TituloCurso
            FROM Diploma d
            JOIN Usuario u ON d.EstudianteID = u.ID
            JOIN Usuario i ON d.InstructorID = i.ID
            JOIN Curso c ON d.CursoID = c.ID
            WHERE d.EstudianteID = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuarioID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
