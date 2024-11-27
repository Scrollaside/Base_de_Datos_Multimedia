<?php
require_once '../Models/CursoD.php';

class CursoController{
    public function traerDatos(){
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            if($data['option'] == 1){
                $curso = new Curso();
                $cursoInfo = $curso->obtenerDetalleCurso($data['ID']);
                $nivelesInfo = $curso->obtenerNivelesCurso($data['ID']);
                $comentariosInfo = $curso->obtenerComentariosCurso($data['ID']);

                if($cursoInfo && $nivelesInfo){
                    if($comentariosInfo){
                        echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => $comentariosInfo]);
                    }else{
                        echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => 'no']);
                    }
                }else{
                    echo json_encode(['success' => false, 'error' => 'Curso no encontrado.']);
                }
            }else if($data['option'] == 2){
                $curso = new Curso();
                $nivelInfo = $curso->obtenerNivelIndividual($data['IdNivel']);

                if($nivelInfo){
                    echo json_encode(['success' => true, 'nivel' => $nivelInfo]);
                }else{
                    echo json_encode(['success' => false, 'error' => 'Nivel no encontrado.']);
                }
            }else if($data['option'] == 3){
                $curso = new Curso();
                $cursoInfo = $curso->obtenerDetalleCurso($data['ID']);
                $nivelInfo = $curso->obtenerNivelIndividual($data['idNivel']);

                if($cursoInfo && $nivelInfo){
                    echo json_encode(['success' => true, 'curso' => $cursoInfo, 'nivel' => $nivelInfo]);
                }else{
                    echo json_encode(['success' => false, 'error' => 'Nivel no encontrado.']);
                }
            }else if($data['option'] == 4){
                $curso = new Curso();
                $validacion = $curso->borrarComentario($data['idComentario']);

                if($validacion){
                    echo json_encode(['success' => true]);
                }else{
                    echo json_encode(['success' => false]);
                }
            }
        }
    }
}
?>