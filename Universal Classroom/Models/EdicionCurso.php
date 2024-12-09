<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/database.php';

class EdicionCurso
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db->conectar(); 
    }

    // Obtener información del curso
    public function obtenerInformacionCurso($cursoID)
    {
        $query = "SELECT Titulo, Descripcion, Imagen, Costo FROM Curso WHERE ID = ?";
        $stmt = $this->pdo->prepare($query); 
        $stmt->execute([$cursoID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener las categorías asociadas a un curso
    public function obtenerCategoriasCurso($cursoID)
    {
        $query = "SELECT c.ID, c.Nombre 
                  FROM Categoria c
                  INNER JOIN CursoCategoria cc ON c.ID = cc.CategoriaID
                  WHERE cc.CursoID = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$cursoID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar información del curso
    public function actualizarCurso($cursoID, $titulo, $descripcion, $costo)
    {
        $query = "UPDATE Curso SET Titulo = ?, Descripcion = ?, Costo = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$titulo, $descripcion, $costo, $cursoID]);
    }

    // Actualizar foto del curso
    public function actualizarFotoCurso($cursoID, $imagen)
    {
        $query = "UPDATE Curso SET Imagen = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$imagen, $cursoID]);
    }


    // Actualizar categorías asociadas al curso
    public function actualizarCategoriasCurso($cursoID, $nuevasCategorias)
    {
        $this->pdo->beginTransaction();

        // Eliminar categorías actuales
        $deleteQuery = "DELETE FROM CursoCategoria WHERE CursoID = ?";
        $deleteStmt = $this->pdo->prepare($deleteQuery);
        $deleteStmt->execute([$cursoID]);

        // Insertar nuevas categorías
        $insertQuery = "INSERT INTO CursoCategoria (CursoID, CategoriaID) VALUES (?, ?)";
        $insertStmt = $this->pdo->prepare($insertQuery);

        foreach ($nuevasCategorias as $categoriaID) {
            $insertStmt->execute([$cursoID, $categoriaID]);
        }

        return $this->pdo->commit();
    }

    // Obtener todas las categorías disponibles
    public function obtenerTodasLasCategorias()
    {
        $query = "SELECT ID, Nombre FROM Categoria";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar todas las categorias del curso
    public function eliminarCategoriasPorCurso($cursoId) {
        $sql = "DELETE FROM CursoCategoria WHERE CursoID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $cursoId, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    // Agregar las nuevas categorias al curso
    public function insertarCategoriaCurso($cursoId, $categoriaId) {
        $sql = "INSERT INTO CursoCategoria (CursoID, CategoriaID) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $cursoId, PDO::PARAM_INT);
        $stmt->bindParam(2, $categoriaId, PDO::PARAM_INT);
        $stmt->execute();
    }
}


// Procesar solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new db();
    $edicionCurso = new EdicionCurso($db);

    $action = $_POST['action'] ?? null;

    if ($action === 'actualizarInformacion') {
        $cursoID = $_POST['cursoID'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $costo = $_POST['costo'];

        if ($edicionCurso->actualizarCurso($cursoID, $titulo, $descripcion, $costo)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la información.']);
        }
    } elseif ($action === 'actualizarImagen') {
        $cursoID = $_POST['cursoID'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

        if ($edicionCurso->actualizarFotoCurso($cursoID, $imagen)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la imagen.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
    }
}
?>