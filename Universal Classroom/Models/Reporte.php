<?php
require_once PROJECT_ROOT . '/Controllers/database.php';

class Reporte {
    private $conn;
    public $tipoUsuario;
  // public $Usuario;
    // public $Nombre;
    // public $FechaRegistro;
    // public $CantidadCursos;
    // public $Total;
    
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }

    public function ObtenerReporte() {
        $this->obtenerConexion();
        
        // Validar el tipo de usuario
        if ($this->tipoUsuario === 'Reporte de Instructores') {
            $tipo = 1;
          
        } elseif ($this->tipoUsuario === 'Reporte de Estudiantes') {
            $tipo = 2;
        } else {
            echo json_encode(["error" => "Tipo de usuario inválido"]);
            return;
        }

        // Llamar al procedimiento almacenado
        $query = "CALL ReporteUsuarios(?)";
        $consulta = $this->conn->prepare($query);
        $consulta->bindParam(1, $tipo, PDO::PARAM_INT);

        try {
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

            // Verificar si hay resultados
            if (count($resultado) > 0) {
                echo json_encode($resultado); // Retorna datos como JSON
            } else {
                echo json_encode(["error" => "No se encontraron resultados."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function mostrarReporteVentas(){
        $this->obtenerConexion();
        $query = "CALL GananciasTotales()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
       
    }
}
?>
