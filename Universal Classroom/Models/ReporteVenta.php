<?php
require_once PROJECT_ROOT . '../Controllers/database.php';

class ReporteVenta {
    private $conn;

    public $Instructor;
    public $FechaDesde;
    public $FechaHasta;
    public $Curso;
    public $Estado;
   
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }
   
    public function GetDate() {
        try {
            $this->obtenerConexion();
            // Consulta para obtener la fecha formateada
            $query = "SELECT DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS fechaFormateada";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        
            // Recuperar el resultado
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['fechaFormateada']; // Devuelve la fecha
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
            return null;
        }
    }
    

    public function TablaGeneral($instructor) {
        $this->obtenerConexion();
        $fechaHasta = $this->GetDate();
        // Parámetros para el procedimiento almacenado
        $fechaDesde = '01/01/2000';
       // $fechaHasta = '03/12/2024'; // Fecha actual en formato 'día/mes/año'
        $curso = 'Todas';
        $estado = 'Todos';
    
        // Consulta para llamar al procedimiento almacenado
        $query = "CALL VentasGeneralSP(?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->conn->prepare($query);
            // Asignar parámetros
            $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
            $stmt->bindParam(2, $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(3, $fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam(4, $curso, PDO::PARAM_STR);
            $stmt->bindParam(5, $estado, PDO::PARAM_STR);
    
            // Ejecutar consulta
            $stmt->execute();
    
            // Obtener los resultados
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            echo json_encode([
                "success" => true,
                "data" => $resultado
            ]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
    
    
}
?>
