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
    

    public function TablaGeneral($instructor, $fechaDesde, $fechaHasta, $categoria, $estado) {
        $this->obtenerConexion();
        if ($fechaDesde == 'all'){
            $fechaDesde = '01/01/1000';
        }

        if ($fechaHasta == 'all'){
            $fechaHasta = $this->GetDate();
        }
        // $categoria = 'Todas';
        // $estado = 'Todos';
        // Consulta para llamar al procedimiento almacenado
        $query = "CALL VentasGeneralSP(?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->conn->prepare($query);
            // Asignar parámetros
            $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
            $stmt->bindParam(2, $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(3, $fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam(4, $categoria, PDO::PARAM_STR);
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


    public function TablaPorCurso($instructor, $fechaDesde, $fechaHasta, $categoria, $estado, $curso) {
        $this->obtenerConexion();
        if ($fechaDesde == 'all'){
            $fechaDesde = '01/01/1000';
        }

        if ($fechaHasta == 'all'){
            $fechaHasta = $this->GetDate();
        }
        // $categoria = 'Todas';
        // $estado = 'Todos';
        // Consulta para llamar al procedimiento almacenado
        $query = "CALL VentasPorCursoSP(?, ?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->conn->prepare($query);
            // Asignar parámetros
            $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
            $stmt->bindParam(2, $curso, PDO::PARAM_STR);
            $stmt->bindParam(3, $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(4, $fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam(5, $categoria, PDO::PARAM_STR);
            $stmt->bindParam(6, $estado, PDO::PARAM_STR);
    
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


    public function IngresosGeneral($instructor, $fechaDesde, $fechaHasta, $categoria, $estado) {
        $this->obtenerConexion();
        if ($fechaDesde == 'all'){
            $fechaDesde = '01/01/1000';
        }

        if ($fechaHasta == 'all'){
            $fechaHasta = $this->GetDate();
        }
        // $categoria = 'Todas';
        // $estado = 'Todos';
        // Consulta para llamar al procedimiento almacenado
        $query = "CALL GananciasTotalesSP(?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->conn->prepare($query);
            // Asignar parámetros
            $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
            $stmt->bindParam(2, $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(3, $fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam(4, $categoria, PDO::PARAM_STR);
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

    
    public function IngresosPorCurso($instructor, $fechaDesde, $fechaHasta, $categoria, $estado, $curso) {
        $this->obtenerConexion();
        if ($fechaDesde == 'all'){
            $fechaDesde = '01/01/1000';
        }

        if ($fechaHasta == 'all'){
            $fechaHasta = $this->GetDate();
        }
        // $categoria = 'Todas';
        // $estado = 'Todos';
        // Consulta para llamar al procedimiento almacenado
        $query = "CALL GananciasPorCursoSP(?, ?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->conn->prepare($query);
            // Asignar parámetros
            $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
            $stmt->bindParam(2, $curso, PDO::PARAM_STR);
            $stmt->bindParam(3, $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(4, $fechaHasta, PDO::PARAM_STR);
            $stmt->bindParam(5, $categoria, PDO::PARAM_STR);
            $stmt->bindParam(6, $estado, PDO::PARAM_STR);
    
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

    
    public function TotalIngresos($instructor, $fechaDesde, $fechaHasta, $categoria, $estado, $curso) {
        $this->obtenerConexion();
        if ($fechaDesde == 'all'){
            $fechaDesde = '01/01/1000';
        }

        if ($fechaHasta == 'all'){
            $fechaHasta = $this->GetDate();
        }
        // $categoria = 'Todas';
        // $estado = 'Todos';
        // Consulta para llamar al procedimiento almacenado
        if ($curso == 'all') {
            $query = "CALL TotalIngresos1SP(?, ?, ?, ?, ?)";
    
            try {
                $stmt = $this->conn->prepare($query);
                // Asignar parámetros
                $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
                $stmt->bindParam(2, $fechaDesde, PDO::PARAM_STR);
                $stmt->bindParam(3, $fechaHasta, PDO::PARAM_STR);
                $stmt->bindParam(4, $categoria, PDO::PARAM_STR);
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
        else {
            $query = "CALL TotalIngresos2SP(?, ?, ?, ?, ?, ?)";
    
            try {
                $stmt = $this->conn->prepare($query);
                // Asignar parámetros
                $stmt->bindParam(1, $instructor, PDO::PARAM_STR);
                $stmt->bindParam(2, $curso, PDO::PARAM_STR);
                $stmt->bindParam(3, $fechaDesde, PDO::PARAM_STR);
                $stmt->bindParam(4, $fechaHasta, PDO::PARAM_STR);
                $stmt->bindParam(5, $categoria, PDO::PARAM_STR);
                $stmt->bindParam(6, $estado, PDO::PARAM_STR);
                
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
    
}
?>
