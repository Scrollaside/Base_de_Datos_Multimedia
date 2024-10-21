<?php
require_once 'config/database.php';

class Usuario {
    private $conn;
    private $table_name = "Usuario";

    public $nombreCompleto;
    public $genero;
    public $fechaNacimiento;
    public $foto;
    public $email;
    public $contraseña;
    public $tipoUsuario;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function registrarUsuario() {
        $query = "CALL RegistrarUsuario(:nombre, :genero, :fechaNacimiento, :foto, :email, :contraseña, :tipoUsuario)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombreCompleto);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
        $stmt->bindParam(':foto', $this->foto, PDO::PARAM_LOB);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':contraseña', $this->contraseña);
        
        // Asignar el valor numérico del tipo de usuario
        $tipoUsuario = $this->tipoUsuario === 'Estudiante' ? 1 : 2;
        $stmt->bindParam(':tipoUsuario', $tipoUsuario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
