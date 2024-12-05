<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '../Models/ReporteVenta.php';

class ReporteVentaController {

    
    public function VentasGeneral() {
        $Reporte = new ReporteVenta();
        $Reporte->instructor = trim($_POST['instructor']);
        $Reporte->fechaInicio = trim($_POST['fechaInicio']);
        $Reporte->fechaFin = trim($_POST['fechaFin']);
        $Reporte->categoria = trim($_POST['categoria']);
        $Reporte->estado = trim($_POST['estado']);
        
        $Reporte->TablaGeneral($Reporte->instructor, $Reporte->fechaInicio, $Reporte->fechaFin, $Reporte->categoria, $Reporte->estado);
    }

    public function IngresosGeneral() {
        $Reporte = new ReporteVenta();
        $Reporte->instructor = trim($_POST['instructor']);
        $Reporte->fechaInicio = trim($_POST['fechaInicio']);
        $Reporte->fechaFin = trim($_POST['fechaFin']);
        $Reporte->categoria = trim($_POST['categoria']);
        $Reporte->estado = trim($_POST['estado']);
        
        $Reporte->IngresosGeneral($Reporte->instructor, $Reporte->fechaInicio, $Reporte->fechaFin, $Reporte->categoria, $Reporte->estado);
    }  

    public function VentasPorCurso() {
        $Reporte = new ReporteVenta();
        $Reporte->instructor = trim($_POST['instructor']);
        $Reporte->fechaInicio = trim($_POST['fechaInicio']);
        $Reporte->fechaFin = trim($_POST['fechaFin']);
        $Reporte->categoria = trim($_POST['categoria']);
        $Reporte->estado = trim($_POST['estado']);
        $Reporte->curso = trim($_POST['curso']);
        
        $Reporte->TablaPorCurso($Reporte->instructor, $Reporte->fechaInicio, $Reporte->fechaFin, $Reporte->categoria, $Reporte->estado, $Reporte->curso);
    }

    
    public function GananciasPorCurso() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); 
    }    
}

?>
