<?php
require_once '../Controllers/database.php';

class Usuario {
    private $conn;

    public $nombreCompleto;
    public $nombreUsuario;
    public $genero;
    public $fechaNacimiento;
    public $foto;
    public $email;
    public $contraseña;
    public $tipoUsuario;

    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }

    public function registrarUsuario() {
        $this->obtenerConexion();

        // Establecer el tipo de usuario
        if ($this->tipoUsuario === 'Estudiante') {
            $this->tipoUsuario = 1;
        } elseif ($this->tipoUsuario === 'Instructor') {
            $this->tipoUsuario = 2;
        } else {
            echo "<h2 class='Error'>Tipo de usuario inválido.</h2>";
            return false;
        }

        // Verificar si el nombre de usuario ya está en uso
        $consulta_usuario = "SELECT * FROM Usuario WHERE NombreUsuario = :nombreUsuario";
        $stmt = $this->conn->prepare($consulta_usuario);
        $stmt->bindParam(':nombreUsuario', $this->nombreUsuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h2 class='Error'>PRUEBA 3.</h2>";
            echo "<h2 class='Error'>El nombre de usuario ya está en uso. Por favor, elige otro.</h2>";
            return false;
        }

        if (empty($this->foto)) {
            echo "<h2 class='Error'>La foto no tiene datos válidos.</h2>";
            return false;
        }
       

        // Llamar al procedimiento almacenado 'RegistrarUsuario'
        $query = "CALL RegistrarUsuario(?, ?, ?, ?, ?, ?, ?, ?)";
        
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

    public function validarLogin($nombreUsuario, $contraseña) {
        $this->obtenerConexion();
        $query = "SELECT ID, NombreUsuario, Contraseña, TipoUsuario FROM Usuario WHERE NombreUsuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombreUsuario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario['Contraseña'] === $contraseña) {
                // Retorna los detalles del usuario si el login es correcto
                return $usuario;
            }
        }

        // Si no coincide, retorna false
        return false;
    }



}
?>
