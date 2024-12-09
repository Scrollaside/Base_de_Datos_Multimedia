<?php
require_once __DIR__ . '/../config.php';

class Curso {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=" . db_host . ";dbname=" . db_name, db_user, db_pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES " . db_charset);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Obtener información de algún curso
    public function obtenerCursoPorId($id) {
        $sql = "SELECT * FROM Cursos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Views del index.php para mostrar los mas vendidos, recientes y calificados
    public function obtenerCursosPorCriterio($criterio) {
        $sql = "SELECT * FROM ";
    
        // Cambia la consulta según el criterio
        if ($criterio === 'MasVendidos') {
            $sql .= "View_MasVendidos";
        } elseif ($criterio === 'MejoresCalificados') {
            $sql .= "View_MejoresCalificados";
        } elseif ($criterio === 'MasRecientes') {
            $sql .= "View_MasRecientes";
        } else {
            throw new Exception("Criterio no válido");
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener todos los cursos creados por un usuario
    public function obtenerCursoPorCreador($id) {
        $sql = "SELECT * FROM Curso WHERE UsuarioCreador = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cambiar si el curso está dado de alta o no
    public function actualizarEstadoCurso($cursoID, $nuevoEstado) {
        $sql = "UPDATE Curso SET Estado = ? WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nuevoEstado, $cursoID]);
        return $stmt->rowCount() > 0;
    }

    // Insertar nuevo curso
    public function insertarCurso($titulo, $imagen, $descripcion, $costo, $cantidadNiveles, $usuarioCreador) {
        $sql = "INSERT INTO Curso (Titulo, Imagen, Descripcion, Costo, CantidadNiveles, UsuarioCreador)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$titulo, $imagen, $descripcion, $costo, $cantidadNiveles, $usuarioCreador]);
        return $this->db->lastInsertId(); // Devuelve el ID del curso insertado
    }

    // Insertar Categorias de un curso
    public function insertarCategoriasCurso($cursoId, $categorias) {
        $sql = "INSERT INTO CursoCategoria (CursoID, CategoriaID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
    
        foreach ($categorias as $categoriaId) {
            $stmt->execute([$cursoId, $categoriaId]);
        }
    }
}

// Procesar la solicitud desde fetch
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (!isset($_SESSION['ID'])) {
        echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
        exit;
    }

    $usuarioCreador = $_SESSION['ID'];

    // Verificar qué acción realizar: crear curso o insertar categorías
    if (isset($_POST['accion']) && $_POST['accion'] === 'insertarCategorias') {
        // Insertar categorías asociadas a un curso ya creado
        $cursoId = $_POST['cursoId'] ?? null;
        $categorias = json_decode($_POST['categorias'], true) ?? [];

        if (!$cursoId || empty($categorias)) {
            echo json_encode(['success' => false, 'message' => 'ID de curso y categorías requeridos.']);
            exit;
        }

        try {
            $cursoModel = new Curso();
            $cursoModel->insertarCategoriasCurso($cursoId, $categorias);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al insertar categorías: ' . $e->getMessage()]);
        }
    } else {
        // Insertar el curso
        $titulo = $_POST['titulo'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $costo = $_POST['costo'] ?? 0;
        $cantidadNiveles = $_POST['cantidadNiveles'] ?? 1;

        if (empty($titulo) || empty($descripcion) || empty($costo) || empty($cantidadNiveles) || !isset($_FILES['imagen']['tmp_name'])) {
            echo json_encode(['success' => false, 'message' => 'Todos los campos deben ser rellenados.']);
            exit;
        }

        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

        try {
            $cursoModel = new Curso();
            // Insertar el curso
            $cursoId = $cursoModel->insertarCurso($titulo, $imagen, $descripcion, $costo, $cantidadNiveles, $usuarioCreador);

            echo json_encode(['success' => true, 'cursoId' => $cursoId]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al insertar el curso: ' . $e->getMessage()]);
        }
    }
}
