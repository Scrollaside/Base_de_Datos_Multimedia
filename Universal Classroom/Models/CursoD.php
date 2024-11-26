<?php
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
        $query = 'SELECT * FROM ObtenerComentariosCurso WHERE ID = ?';
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
}
?>