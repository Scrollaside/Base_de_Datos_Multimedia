<?php
// Incluir la clase db desde el archivo database.php
require_once __DIR__ . '/../Controllers/database.php';


class KardexModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    public function GetDate() {
        try {
            //$this->obtenerConexion();
            // Consulta para obtener la fecha formateada
            $query = "SELECT DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS fechaFormateada";
            $stmt = $this->conexion->conectar()->prepare($query);
            $stmt->execute();
        
            // Recuperar el resultado
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['fechaFormateada']; // Devuelve la fecha
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
            return null;
        }
    }



    // Obtener niveles inscritos, ajustado para incluir datos necesarios
    public function obtenerNivelesInscritos($userId) {
        $sql = "SELECT n.ID AS nivel_id, c.Titulo AS nombre_curso, n.Nombre AS nombre_nivel, 
                       i.FechaInscripcion, i.FechaAcceso, i.FechaFinalizacion
                FROM Inscripcion i
                JOIN Nivel n ON i.NivelID = n.ID
                JOIN Curso c ON n.CursoID = c.ID
                WHERE i.UsuarioID = :userId";

        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cursos inscritos, con detalles adicionales para la segunda tabla
    public function obtenerDetallesCursos($userId) {
        $sql = "SELECT c.ID AS curso_id, c.Titulo AS nombre_curso, c.Estado, 
                       MIN(i.FechaInscripcion) AS fecha_inscripcion, 
                       MAX(i.FechaAcceso) AS ultima_fecha_acceso,
                       MAX(d.FechaFin) AS fecha_finalizacion
                FROM Curso c
                LEFT JOIN Nivel n ON c.ID = n.CursoID
                LEFT JOIN Inscripcion i ON n.ID = i.NivelID AND i.UsuarioID = :userId
                LEFT JOIN Diploma d ON d.EstudianteID = :userId AND d.CursoID = c.ID
                WHERE c.ID IN (
                    SELECT n.CursoID
                    FROM Inscripcion i
                    JOIN Nivel n ON i.NivelID = n.ID
                    WHERE i.UsuarioID = :userId
                )
                GROUP BY c.ID, c.Titulo, c.Estado";
    
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener los niveles de un curso
    public function obtenerNivelesPorCurso($cursoId) {
        $sql = "SELECT ID 
                FROM Nivel 
                WHERE CursoID = :cursoId
                ORDER BY Numero"; 
    
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':cursoId', $cursoId);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Verificar inscripción de usuario en un nivel específico
    public function obtenerEstadoNivel($userId, $nivelId) {
        $sql = "SELECT Estado 
                FROM Inscripcion 
                WHERE UsuarioID = :userId AND NivelID = :nivelId";
    
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':nivelId', $nivelId);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['Estado'] == 1 ? 'Completo' : 'En progreso';
        }
        return 'No disponible';
    }
    

    public function obtenerRelacionesCursoCategoria() {
        $sql = "SELECT cc.CursoID, cc.CategoriaID 
                FROM CursoCategoria cc";

        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cursoCategorias = [];
        foreach ($result as $row) {
            $cursoId = $row['CursoID'];
            $categoriaId = (int)$row['CategoriaID'];

            if (!isset($cursoCategorias[$cursoId])) {
                $cursoCategorias[$cursoId] = [];
            }

            $cursoCategorias[$cursoId][] = $categoriaId;
        }

        return $cursoCategorias;
    }

    public function obtenerCursosPorCategoria($categoriaId) {
        $sql = "SELECT CursoID 
                FROM CursoCategoria 
                WHERE CategoriaID = :categoriaId";
        
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(':categoriaId', $categoriaId);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Retorna solo los IDs
    }
    
    
}
