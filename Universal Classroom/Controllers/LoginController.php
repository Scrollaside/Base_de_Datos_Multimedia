<?php
require_once PROJECT_ROOT . '/Models/Usuario.php';
session_start();

class LoginController {
    public function login() {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtén el cuerpo de la solicitud
            $data = json_decode(file_get_contents('php://input'), true);
            $nombreUsuario = trim($data['usuario']);
            $contraseña = trim($data['password']);
    
            $usuario = new Usuario();
            $resultado = $usuario->validarLogin($nombreUsuario, $contraseña);

            if ($resultado) {
                // Guardar en la sesión solo los datos necesarios
                $_SESSION['ID'] = $resultado['ID'];
                $_SESSION['NombreCompleto'] = $resultado['NombreCompleto'];
                $_SESSION['NombreUsuario'] = $resultado['NombreUsuario'];
                $_SESSION['Genero'] = $resultado['Genero'];
                $_SESSION['FechaNacimiento'] = $resultado['FechaNacimiento'];
                $_SESSION['Email'] = $resultado['Email'];
                $_SESSION['Contraseña'] = $resultado['Contraseña'];
                $_SESSION['TipoUsuario'] = $resultado['TipoUsuario'];
                $_SESSION['Estado'] = $resultado['Estado'];

                // Login exitoso, guarda los datos en Local Storage
                echo json_encode([
                    'success' => true,
                    'ID' => $resultado['ID'],
                    'NombreUsuario' => $resultado['NombreUsuario'],
                    'TipoUsuario' => $resultado['TipoUsuario']
                ]);
            } 
            else if (isset($usuario->messageError)) {
                // Respuesta de error
                echo json_encode(['success' => false, 'error' => $usuario->messageError]);
            }
            else {
                echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
        }
    }
    
}
?>
