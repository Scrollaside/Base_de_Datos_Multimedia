<?php
require_once '../Models/Usuario.php';

class RegistroController {

    public function registrar() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario();
            $usuario->nombreCompleto = trim($_POST['nombreCompleto']);
            $usuario->nombreUsuario = trim($_POST['nombreUsuario']);
            $usuario->genero = trim($_POST['genero']) === "Masculino" ? 'M' : ($_POST['genero'] === "Femenino" ? 'F' : 'O');
            $usuario->fechaNacimiento = trim($_POST['fechaNacimiento']);
           
           if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $usuario->foto = file_get_contents($_FILES['foto']['tmp_name']);
           } else {
               echo "Error al subir la imagen.";
               return;
           }

            $usuario->email = trim($_POST['email']);
            $usuario->contraseña = trim($_POST['password']);
            //$usuario->contraseña = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
            $usuario->tipoUsuario = trim($_POST['tipoUsuario']); // Aquí deberías dejarlo como string
    
            if ($usuario->registrarUsuario()) {
                header("Location:login.php");
                //exit();  // Redirigir al login después de un registro exitoso
            } else {
                echo "Error al registrar el usuario.";  // Mostrar un mensaje de error si falla
            }
        }
    }
    
}
?>
