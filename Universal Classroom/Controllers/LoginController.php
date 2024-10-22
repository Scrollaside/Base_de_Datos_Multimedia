<?php
require_once '../models/Usuario.php';

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
                // Login exitoso, guarda los datos en Local Storage
                echo json_encode([
                    'success' => true,
                    'ID' => $resultado['ID'],
                    'NombreUsuario' => $resultado['NombreUsuario'],
                    'TipoUsuario' => $resultado['TipoUsuario']
                ]);
            } else {
                // Usuario no encontrado o contraseña incorrecta
                echo json_encode(['success' => false, 'error' => 'El usuario y/o la contraseña son incorrectos.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
        }
    }
    
}
?>
