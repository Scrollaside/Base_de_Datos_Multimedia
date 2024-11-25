<?php
require_once '../Controllers/database.php';

class Categoria {
    private $conn;

    public $Nombre;
    public $Descripcion;
    public $Creador;
    public $Creacion;
   
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }

    public function registrarCategoria() {
        $this->obtenerConexion();

        // Establecer el tipo de usuario
      
        // Verificar si el nombre de usuario ya está en uso
        $consulta_categoria = "SELECT * FROM Categoria WHERE Nombre = :nombreCategoria";
        $stmt = $this->conn->prepare($consulta_categoria);
        $stmt->bindParam(':nombreCategoria', $this->nombreCategoria);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h2 class='Error'>PRUEBA 3.</h2>";
            echo "<h2 class='Error'>El nombre de categoria ya está en uso. Por favor, elige otro.</h2>";
            return false;
        }
      

        // Llamar al procedimiento almacenado 'RegistrarUsuario'
        $query = "CALL RegistrarCategoria(?, ?, ?, ?)";
        
        // Preparar la consulta
        $consulta = $this->conn->prepare($query);

        $foto_param = $this->foto !== null ? $this->foto : null;
        //var_dump($this->nombreCompleto, $this->nombreUsuario, $this->genero, $this->fechaNacimiento, $foto_param, $this->email, $this->contraseña, $this->tipoUsuario);
        // Vincular los parámetros
        $consulta->bindParam(1, $this->nombreCompleto);
        $consulta->bindParam(2, $this->nombreUsuario);
        $consulta->bindParam(3, $this->genero);
        $consulta->bindParam(4, $this->fechaNacimiento);
        $consulta->bindParam(5, $foto_param, PDO::PARAM_LOB);
        $consulta->bindParam(6, $this->email);
        $consulta->bindParam(7, $this->contraseña);
        $consulta->bindParam(8, $this->tipoUsuario, PDO::PARAM_INT);

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

    public function ListarCategorias() {
        $this->obtenerConexion();
        
        // Validar el tipo de usuario
      
        // Llamar al procedimiento almacenado
        $query = "SELECT * FROM VistaCategorias";
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
    public function obtenerCategoriaporID($id) {
        $this->obtenerConexion();
        $query = "SELECT Nombre, Descripcion FROM Categoria WHERE ID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return false;
    }

    public function actualizarCategoria($id, $nombre, $desc) {
        $this->obtenerConexion();
        $query = "CALL ActualizarCategoria(?, ?, ?)";
               
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(3, $desc, PDO::PARAM_STR);
            
        return $stmt->execute();
    }
    
}
?>
