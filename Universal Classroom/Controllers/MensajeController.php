<?php
require_once '../Models/Mensaje.php';

class MensajeController{
    public function traerDatos(){
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            if($data['option'] == 1){
                $mensaje = new Mensaje();
                $miembros = $mensaje->obtenerMiembros($data['idNivel']);

                if($miembros){
                    echo json_encode(['success' => true, 'miembros' => $miembros]);
                }else{
                    echo json_encode(['success' => false, 'error' => 'No hay miembros.']);
                }
            }else if($data['option'] == 2){
                $mensaje = new Mensaje();
                $mensajes = $mensaje->obtenerMesajePrivado($data['idNivel'], $data['idUsuarioIS'], $data['idUsuarioChat']);

                if($mensajes){
                    echo json_encode(['success' => true, 'mensajes' => $mensajes]);
                }else{
                    echo json_encode(['success' => false, 'error' => 'No hay mensajes.']);
                }
            }
        }
    }
}
?>