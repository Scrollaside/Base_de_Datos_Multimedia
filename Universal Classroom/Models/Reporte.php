<?php
require_once '../Controllers/database.php';

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

        if ($this->tipoUsuario === 'Reporte de Estudiantes') {
            $this->tipoUsuario = 1;
        } elseif ($this->tipoUsuario === 'Reporte de Instructores') {
            $this->tipoUsuario = 2;
        } else {
            echo "<h2 class='Error'>Tipo de usuario inválido.</h2>";
            return false;
        }

        // Llamar al procedimiento almacenado 'RegistrarUsuario'
        $query = "CALL ReporteUsuarios(?)";
        
        // Preparar la consulta
        $consulta = $this->conn->prepare($query);

        //var_dump($this->nombreCompleto, $this->nombreUsuario, $this->genero, $this->fechaNacimiento, $foto_param, $this->email, $this->contraseña, $this->tipoUsuario);
        // Vincular los parámetros
        $consulta->bindParam(1, $this->tipoUsuario);
       

        //$consulta->debugDumpParams(); // Para depurar en caso de error
        
        // Ejecutar la consulta
        try {
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }


    // public function obtenerUsuarioPorID($id) {
    //     $this->obtenerConexion();
    //     $query = "SELECT NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña FROM Usuario WHERE ID = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(1, $id);
    //     $stmt->execute();
    
    //     if ($stmt->rowCount() > 0) {
    //         return $stmt->fetch(PDO::FETCH_ASSOC);
    //     }
    
    //     return false;
    // }


}
?>
