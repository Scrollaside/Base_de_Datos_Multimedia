<?php
require_once PROJECT_ROOT . '/Models/Usuario.php';

class UserProfileController {
    public function obtenerPerfil() {
        header('Content-Type: application/json');
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtén el cuerpo de la solicitud
            $data = json_decode(file_get_contents('php://input'), true);
            $idUsuario = trim($data['ID']);

            $usuario = new Usuario();
            $usuarioInfo = $usuario->obtenerUsuarioPorID($idUsuario);

            if ($usuarioInfo) {
                echo json_encode(['success' => true] + $usuarioInfo);
            } else {
                echo json_encode(['success' => false, 'error' => 'Usuario no encontrado.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
        }
    }
}
?>
