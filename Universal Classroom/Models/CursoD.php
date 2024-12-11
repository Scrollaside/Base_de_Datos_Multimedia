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
        $validacion = $stmt->rowCount();

        if ($validacion == 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else if ($validacion > 0){
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

    //Buscar en la bd si existe el diploma de un alumno
     public function verificarDiploma($idUsuario, $idCurso){
        $this->obtenerConexion();
        $query = 'SELECT d.*, u.NombreUsuario FROM Diploma d INNER JOIN Usuario u ON d.EstudianteID = u.ID WHERE d.EstudianteID = ? AND d.CursoID = ?;';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idCurso);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    //Buscar en la bd si existe el diploma de un alumno

    //Actualizar en la bd el estado del nivel
    public function actualizarNivel($idUsuario, $idNivel){
        $this->obtenerConexion();
        $query = 'CALL actualizarEstadoNivel(?, ?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idNivel);
        $stmt->bindParam(2, $idUsuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    //Actualizar en la bd el estado del nivel

    //Buscar en la bd nivel individual
    public function obtenerNivelesNoInscritos($idUsuario, $idCurso){
        $this->obtenerConexion();
        $query = 'CALL ObtenerNivelesNoInscritos(?, ?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idUsuario);
        $stmt->bindParam(2, $idCurso);
        $stmt->execute();
        $validacion = $stmt->rowCount();

        if ($validacion == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else if ($validacion > 1){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    //Buscar en la bd nivel individual

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

    //Crear comentario e insertarlo en la bd
    public function crearComentario($texto, $calificacion, $idUsuario, $idCurso){
        $this->obtenerConexion();
        $query = 'CALL AgregarComentario (?, ?, ?, ?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $texto);
        $stmt->bindParam(2, $calificacion);
        $stmt->bindParam(3, $idUsuario);
        $stmt->bindParam(4, $idCurso);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }
    //Crear comentario e insertarlo en la bd

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

//Borrar comentario admin
public function borrarCurso($idCurso){
    $this->obtenerConexion();
    $query = 'UPDATE Curso SET Estado = "Inactivo" WHERE ID = ?;';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $idCurso);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    }else{
        return false;
    }
}
//Borrar comentario admin

}
?>