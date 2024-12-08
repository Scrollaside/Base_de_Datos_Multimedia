<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '/Controllers/database.php';

class EdicionCurso
{
    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db->conectar(); // Aseguramos obtener la instancia PDO
    }

    // Obtener información del curso
    public function obtenerInformacionCurso($cursoID)
    {
        $query = "SELECT Titulo, Descripcion, Imagen, Costo FROM Curso WHERE ID = ?";
        $stmt = $this->pdo->prepare($query); // Usamos PDO aquí
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
    public function actualizarCurso($cursoID, $titulo, $descripcion, $imagen, $costo)
    {
        $query = "UPDATE Curso SET Titulo = ?, Descripcion = ?, Imagen = ?, Costo = ? WHERE ID = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$titulo, $descripcion, $imagen, $costo, $cursoID]);
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
}
?>
