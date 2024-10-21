<?php
require_once 'Controllers/database.php';

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
        $query = "CALL RegistrarUsuario(:nombreCompleto, :nombreUsuario, :genero, :fechaNacimiento, :foto, :email, :contraseña, :tipoUsuario)";

        // Preparar la consulta
        $consulta = $this->conn->prepare($query);

        $foto_param = $this->foto !== null ? $this->foto : null;
              
        // Vincular los parámetros
        $consulta->bindParam(':nombreCompleto', $this->nombreCompleto);
        $consulta->bindParam(':nombreUsuario', $this->nombreUsuario);
        $consulta->bindParam(':genero', $this->genero);
        $consulta->bindParam(':fechaNacimiento', $this->fechaNacimiento);
        $consulta->bindParam(':foto', $foto_param, PDO::PARAM_LOB);
        $consulta->bindParam(':email', $this->email);
        $consulta->bindParam(':contraseña', $this->contraseña);
        $consulta->bindParam(':tipoUsuario', $this->tipoUsuario, PDO::PARAM_INT);

        if (!$consulta->execute()) {
            $consulta->debugDumpParams(); // Esto mostrará los parámetros vinculados y los posibles errores
        }
        
        
        // Ejecutar la consulta
        try {
            if ($consulta->execute()) {
                echo "<h2 class='Exitoso'>Se registró el usuario correctamente</h2>";
            } else {
                echo "<h2 class='Error'>Error al ejecutar el procedimiento almacenado</h2>";
                $consulta->debugDumpParams(); // Para depurar en caso de error
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    public function validarLogin($nombreUsuario, $contraseña) {
        $this->obtenerConexion();
        $query = "SELECT ID_Usuario, NombreUsuario, Contraseña, Type_Usuario FROM Usuario WHERE NombreUsuario = :nombreUsuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombreUsuario', $nombreUsuario);
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
