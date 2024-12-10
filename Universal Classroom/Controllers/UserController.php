<?php
require_once __DIR__ . '/../config.php';
require_once PROJECT_ROOT . '../Models/Usuario.php';
class UserController
{



    public function start()
    {
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->updateUser();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->getUsers();
        }
    }

    public function getUsers()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = new Usuario();
            $resultado =  $user->obtenerUsuarios($data['search']);
            echo json_encode($resultado);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }


    public function updateUser()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $user = new Usuario();
            $resultado =  $user->cambiarEstadoPorId($data['id'],$data['estado']);
            echo json_encode($resultado);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}


$userController = new UserController();
$userController->start();
