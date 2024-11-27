<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Models/Reporte.php';
class ReporteController {
    public function reporte() {
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Leer el cuerpo de la solicitud
            $input = file_get_contents("php://input");
            $data = json_decode($input, true); // Decodificar JSON como arreglo asociativo


                if (isset($data['reporteToggle'])) {
                    $reporte = new Reporte();
                    $reporte->tipoUsuario = trim($data['reporteToggle']); // Recibe el tipo de usuario
                    $reporte->ObtenerReporte(); // Ejecuta el reporte y retorna el JSON
                } else {
                    echo json_encode(["error" => "El campo 'reporteToggle' no fue enviado."]);
                }
            


        } else {
            echo json_encode(["error" => "Método no permitido."]);
        }
    }
}

?>
