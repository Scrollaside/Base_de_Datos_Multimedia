<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once '../Controllers/database.php';

class Mensaje{
    private $conn;
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }

    //Buscar en la bd el creador del curso
    public function obtenerCreador($idCreador){
        $this->obtenerConexion();
        $query = 'SELECT NombreUsuario, Foto, ID AS IdCreador FROM Usuario WHERE ID = ?;';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCreador);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }
    //Buscar en la bd el creador del curso

    //Buscar en la bd los alumnos del instructor
    public function obtenerAlumnos($idCreador){
        $this->obtenerConexion();
        $query = 'CALL obtenerMensajesInstructor(?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idCreador);
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
    //Buscar en la bd los alumnos del instructor

    //Buscar en la bd los mensajes privados
    public function obtenerMesajePrivado($idNivel, $idRemitente, $idDestinatario){
        $this->obtenerConexion();
        $query = 'SELECT * FROM obtenerMensajes WHERE (Remitente = ? AND Destinatario = ?) OR (Remitente = ? AND Destinatario = ?) AND idNivel = ?;';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idRemitente);
        $stmt->bindParam(2, $idDestinatario);
        $stmt->bindParam(3, $idDestinatario);
        $stmt->bindParam(4, $idRemitente);
        $stmt->bindParam(5, $idNivel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }
    //Buscar en la bd los mensajes privados

    //Mandar mensaje
    public function mandarMensaje($texto, $idRemitente, $idDestinatario, $idNivel){
        $this->obtenerConexion();
        $query = 'CALL mandarMensaje(?, ?, ?, ?);';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $texto);
        $stmt->bindParam(2, $idRemitente);
        $stmt->bindParam(3, $idDestinatario);
        $stmt->bindParam(4, $idNivel);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //Mandar mensaje
}

?>