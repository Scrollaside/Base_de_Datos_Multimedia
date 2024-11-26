<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '../Models/Categoria.php';

class CategoriaController {

    
    public function listar() {
        $categoria = new Categoria();
        $categoria->ListarCategorias(); // Llamar al método para listar categorías
    }
    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoria = new Categoria();
            $categoria->nombre = trim($_POST['nombre']);
            $categoria->descripcion = trim($_POST['descripcion']);
            $categoria->creador = trim($_POST['creador']);
           
            if ($categoria->guardarCategoria($categoria->nombre, $categoria->descripcion, $categoria->creador)) {
                echo json_encode(["success" => true, "message" => "Categoría guardada correctamente."]);
            } else {
                echo json_encode(["success" => false, "message" => "Hubo un error al guardar la categoría."]);
               
            }
        }
    }
    
}

?>
