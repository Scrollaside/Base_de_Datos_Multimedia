<?php
require_once '../Models/Reporte.php';

class ReporteController {

    public function reporte() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $reporte = new Reporte();
            $reporte->tipoUsuario = trim($_POST['reporteToggle']); // Aquí deberías dejarlo como string
    
            if ($usuario->ObtenerReporte()) {
                echo'<script language="javascript">alert("Reporte obtenido correctamente.");
                window.location.href="../login.php";</script>';
                //header("Location:../login.php");
                //exit();  // Redirigir al login después de un registro exitoso
            } else {
                echo'<script language="javascript">alert("Hubo un error al obtener el reporte. Intente nuevamente.");</script>';  // Mostrar un mensaje de error si falla
            }
        }
    }
    
}
?>
