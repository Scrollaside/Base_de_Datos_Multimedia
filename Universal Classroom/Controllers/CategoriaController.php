<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '../Models/Categoria.php';

class CategoriaController {

    
    public function listar() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); // Llamar al método para listar categorías
    }
    // public function registrar() {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $categoria = new Categoria();
    //         $categoria->nombre = trim($_POST['nombreCompleto']);
    //         $usuario->nombreUsuario = trim($_POST['nombreUsuario']);
    //         $usuario->genero = trim($_POST['genero']) === "Masculino" ? 'M' : ($_POST['genero'] === "Femenino" ? 'F' : 'O');
    //         $usuario->fechaNacimiento = trim($_POST['fechaNacimiento']);
           
    //        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    //             $usuario->foto = file_get_contents($_FILES['foto']['tmp_name']);
    //        } else {
    //            echo "Error al subir la imagen.";
    //            return;
    //        }

    //         $usuario->email = trim($_POST['email']);
    //         $usuario->contraseña = trim($_POST['password']);
    //         //$usuario->contraseña = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    //         $usuario->tipoUsuario = trim($_POST['tipoUsuario']); // Aquí deberías dejarlo como string
    
    //         if ($usuario->registrarUsuario()) {
    //             echo'<script language="javascript">alert("Usuario registrado correctamente.");
    //             window.location.href="../login.php";</script>';
    //             //header("Location:../login.php");
    //             //exit();  // Redirigir al login después de un registro exitoso
    //         } else {
    //             echo'<script language="javascript">alert("Hubo un error al registrar al usuario. Intente nuevamente.");</script>';  // Mostrar un mensaje de error si falla
    //         }
    //     }
    // }
    
}
// $action = $_GET['action'] ?? null;
// $controller = new CategoriaController();

// if ($action === 'listar') {
//     $controller->listar();
// } else {
//     echo json_encode(["error" => "Acción no válida"]);
// }
?>
