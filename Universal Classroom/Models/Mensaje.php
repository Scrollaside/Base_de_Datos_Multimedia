<?php
require_once __DIR__ . '/../config.php';  // Ruta a config.php
require_once '../Controllers/database.php';

class Mensaje{
    private $conn;
    public function obtenerConexion() {
        $database = new db();
        $this->conn = $database->conectar();
    }

    //Buscar en la bd los miembros del usuario
    public function obtenerMiembros($idNivel){
        $this->obtenerConexion();
        $query = 'SELECT * FROM obtenerMiembrosCurso WHERE IdNivel = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idNivel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }

    }
    //Buscar en la bd los miembros del usuario

    //Buscar en la bd los mensajes privados
    public function obtenerMesajePrivado($idNivel, $idRemitente, $idDestinatario){
        $this->obtenerConexion();
        $query = 'SELECT * FROM obtenerMensajes WHERE (Remitente = ? OR Remitente = ?) AND (Destinatario = ? OR Destinatario = ?) AND idNivel = ?;';
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
}

?>