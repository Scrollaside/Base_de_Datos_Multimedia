<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '../Models/ReporteVenta.php';

class ReporteVentaController {

    
    public function VentasGeneral() {
        $Reporte = new ReporteVenta();
        $Reporte->instructor = trim($_POST['instructor']);
        $Reporte->TablaGeneral($Reporte->instructor);
    }
    // public function GeneralFiltro() {
    //     $categoria = new Categoria();
    //     $categoria->ListarCategorias(); // Llamar al método para listar categorías
    // }
    public function VentasPorCurso() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); // Llamar al método para listar categorías
    }
    // public function PorCursoFiltro() {
    //     $categoria = new Categoria();
    //     $categoria->ListarCategorias(); // Llamar al método para listar categorías
    // }
    public function GananciasTotales() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); // Llamar al método para listar categorías
    }  
    public function GananciasPorCurso() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); // Llamar al método para listar categorías
    }    
}

?>
