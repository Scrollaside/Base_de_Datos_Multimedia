<?php
require_once 'ReporteVentasController.php';

if (isset($_GET['accion'])){
    $accion = $_GET['accion'];
    $controller = new ReporteVentaController();
    
    switch($accion) {
        case 'VentasGeneral':
            $controller->VentasGeneral();
            break;

        case 'IngresosGeneral':
           $controller->IngresosGeneral();
           break;
        
        case 'VentasPorCurso':
            $controller->VentasPorCurso();
            break;

        case 'GananciasPorCurso':
            $controller->GananciasPorCurso();
            break;
    
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se especificó una acción']);
}
?>