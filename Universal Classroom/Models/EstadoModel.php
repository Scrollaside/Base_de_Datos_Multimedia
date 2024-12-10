<?php
require_once __DIR__ . '/../config.php';

class Curso_Estado {
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

   
    // Cambiar si el curso está dado de alta o no
    public function actualizarEstadoCurso($cursoID, $nuevoEstado) {
        $sql = "UPDATE Curso SET Estado = ? WHERE ID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nuevoEstado, $cursoID]);
        return $stmt->rowCount() > 0;
    }

   
}

// // Procesar la solicitud desde fetch
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (session_status() === PHP_SESSION_NONE) {
//         session_start();
//     }

//     if (!isset($_SESSION['ID'])) {
//         echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
//         exit;
//     }

//     $usuarioCreador = $_SESSION['ID'];

//     // Verificar qué acción realizar: crear curso o insertar categorías
//     if (isset($_POST['accion']) && $_POST['accion'] === 'insertarCategorias') {
//         // Insertar categorías asociadas a un curso ya creado
//         $cursoId = $_POST['cursoId'] ?? null;
//         $categorias = json_decode($_POST['categorias'], true) ?? [];

//         if (!$cursoId || empty($categorias)) {
//             echo json_encode(['success' => false, 'message' => 'ID de curso y categorías requeridos.']);
//             exit;
//         }

//         try {
//             $cursoModel = new Curso();
//             $cursoModel->insertarCategoriasCurso($cursoId, $categorias);
//             echo json_encode(['success' => true]);
//         } catch (Exception $e) {
//             echo json_encode(['success' => false, 'message' => 'Error al insertar categorías: ' . $e->getMessage()]);
//         }
//     } else {
//         // Insertar el curso
//         $titulo = $_POST['titulo'] ?? '';
//         $descripcion = $_POST['descripcion'] ?? '';
//         $costo = $_POST['costo'] ?? 0;
//         $cantidadNiveles = $_POST['cantidadNiveles'] ?? 1;

//         if (empty($titulo) || empty($descripcion) || empty($costo) || empty($cantidadNiveles) || !isset($_FILES['imagen']['tmp_name'])) {
//             echo json_encode(['success' => false, 'message' => 'Todos los campos deben ser rellenados.']);
//             exit;
//         }

//         $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

//         try {
//             $cursoModel = new Curso();
//             // Insertar el curso
//             $cursoId = $cursoModel->insertarCurso($titulo, $imagen, $descripcion, $costo, $cantidadNiveles, $usuarioCreador);

//             echo json_encode(['success' => true, 'cursoId' => $cursoId]);
//         } catch (Exception $e) {
//             echo json_encode(['success' => false, 'message' => 'Error al insertar el curso: ' . $e->getMessage()]);
//         }
//     }
// }
