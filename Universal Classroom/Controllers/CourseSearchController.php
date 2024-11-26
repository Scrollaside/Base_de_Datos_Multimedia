<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once PROJECT_ROOT . '/Controllers/database.php';

class CourseSearchController {
    private $db;

    public function __construct() {
        $this->db = new db();
    }

    public function buscarCursos($titulo, $categoria, $usuario, $fechaInicio, $fechaFin) {
        $conexion = $this->db->conectar();
        
        // Crear la consulta base
        $sql = "SELECT c.ID, c.Titulo, c.Descripcion, c.Imagen, c.PromedioCalificacion, u.NombreCompleto AS Creador 
                FROM Curso c 
                JOIN Usuario u ON c.UsuarioCreador = u.ID
                LEFT JOIN CursoCategoria cc ON c.ID = cc.CursoID
                LEFT JOIN Categoria cat ON cc.CategoriaID = cat.ID
                WHERE c.Estado = 'Activo'";

        $params = [];

        // Agregar condiciones según los filtros
        if (!empty($titulo)) {
            $sql .= " AND c.Titulo LIKE :titulo";
            $params[':titulo'] = "%$titulo%";
        }

        if (!empty($categoria)) {
            $sql .= " AND cat.Nombre = :categoria";
            $params[':categoria'] = $categoria;
        }

        if (!empty($usuario)) {
            $sql .= " AND u.NombreCompleto LIKE :usuario";
            $params[':usuario'] = "%$usuario%";
        }

        if (!empty($fechaInicio)) {
            $sql .= " AND c.FechaCreacion >= :fechaInicio";
            $params[':fechaInicio'] = $fechaInicio;
        }

        if (!empty($fechaFin)) {
            $sql .= " AND c.FechaCreacion <= :fechaFin";
            $params[':fechaFin'] = $fechaFin;
        }

        $stmt = $conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
