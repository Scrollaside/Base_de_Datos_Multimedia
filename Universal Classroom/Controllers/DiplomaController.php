<?php
// Archivo: Controllers/DiplomaController.php
require_once './Models/DiplomaModel.php';

class DiplomaController {
    private $diplomaModel;

    public function __construct() {
        $this->diplomaModel = new DiplomaModel();
    }

    public function mostrarDiplomas($usuarioID) {
        // Llama al modelo para obtener los diplomas del usuario
        return $this->diplomaModel->obtenerDiplomasPorUsuario($usuarioID);
    }
}
