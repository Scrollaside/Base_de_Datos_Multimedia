<?php
require_once __DIR__ . '/../config.php';

class Curso {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . db_host . ";dbname=" . db_name, db_user, db_pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES " . db_charset);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function obtenerCursoPorId($id) {
        $sql = "SELECT * FROM Cursos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCursosPorCriterio($criterio) {
        $sql = "SELECT * FROM ";
    
        // Cambia la consulta según el criterio
        if ($criterio === 'MasVendidos') {
            $sql .= "View_MasVendidos";
        } elseif ($criterio === 'MejoresCalificados') {
            $sql .= "View_MejoresCalificados";
        } elseif ($criterio === 'MasRecientes') {
            $sql .= "View_MasRecientes";
        } else {
            throw new Exception("Criterio no válido");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
