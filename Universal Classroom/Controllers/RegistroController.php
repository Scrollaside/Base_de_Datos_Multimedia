<?php
require_once 'models/Usuario.php';

class RegistroController {

    public function registrar() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario();
    
            $usuario->nombreCompleto = $_POST['nombreCompleto'];
            $usuario->genero = $_POST['genero'] === "Masculino" ? 'M' : ($_POST['genero'] === "Femenino" ? 'F' : 'O');
            $usuario->fechaNacimiento = $_POST['fechaNacimiento'];
            $usuario->foto = file_get_contents($_FILES['foto']['tmp_name']); // Asegúrate de manejar el error si no se sube archivo
            $usuario->email = $_POST['email'];
            $usuario->contraseña = $_POST['password'];
            $usuario->tipoUsuario = $_POST['tipoUsuario']; // Aquí deberías dejarlo como string
    
            if ($usuario->registrarUsuario()) {
                header("Location: login.php");
                exit();
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
    
}
?>
