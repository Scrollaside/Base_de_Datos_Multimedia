<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once '../Controllers/database.php';

class Curso{
    //Primero hacer la conexion a la base de datos
    private $conn;
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }
    //Primero hacer la conexion a la base de datos

    //Buscar en la bd los detalles del curso
    public function obtenerDetalleCurso($idCurso){
        $this->obtenerConexion();
        $query = 'SELECT * FROM ObtenerDetalleCurso WHERE ID = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCurso);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }
    //Buscar en la bd los detalles del curso

    //Buscar en la bd los niveles del curso
    public function obtenerNivelesCurso($idCurso){
        $this->obtenerConexion();
        $query = 'SELECT * FROM ObtenerNivelesCurso WHERE ID = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCurso);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    //Buscar en la bd los niveles del curso

    //Buscar en la bd los comentarios del curso
    public function obtenerComentariosCurso($idCurso){
        $this->obtenerConexion();
        $query = 'SELECT * FROM ObtenerComentariosCurso WHERE ID = ? AND Estado = 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCurso);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    //Buscar en la bd los comentarios del curso

    //Buscar en la bd si el usuario está inscrito a algún nivel del curso
    public function obtenerNivelesInscritos($idCurso, $idUsuario){
        $this->obtenerConexion();
        $query = 'SELECT * FROM obtenerMiembrosCurso WHERE IdCurso = ? AND IdUsuario = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCurso);
        $stmt->bindParam(2, $idUsuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }
    //Buscar en la bd si el usuario está inscrito a algún nivel del curso

    //Buscar en la bd nivel individual
    public function obtenerNivelIndividual($idNivel){
        $this->obtenerConexion();
        $query = 'SELECT * FROM ObtenerNivelIndividual WHERE IdNivel = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idNivel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    //Buscar en la bd nivel individual

    //Borrar comentario admin
    public function borrarComentario($idComentario){
        $this->obtenerConexion();
        $query = 'UPDATE Comentario SET Estado = 0 WHERE ID = ?;';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idComentario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    //Borrar comentario admin

    //Insertar inscripción a la bd
    public function crearInscripcion($idUsuario, $idNivel, $idCurso, $metodoPago){
        $this->obtenerConexion();
        $query = 'CALL agregarInscripcion (?, ?, ?, ?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idNivel);
        $stmt->bindParam(3, $idCurso);
        $stmt->bindParam(4, $metodoPago);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    //Insertar inscripción a la bd
}
?>