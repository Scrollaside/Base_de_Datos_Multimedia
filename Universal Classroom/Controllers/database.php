<?php
require_once("config.php");
class db {
    public function conectar() {
        $conexion = new PDO('mysql:host='.db_host.';dbname='.db_name.';charset='.db_charset, db_user, db_pass);
        return $conexion;
    }
}