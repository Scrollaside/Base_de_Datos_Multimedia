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
                $inscripcion = $curso->obtenerNivelesInscritos($data['ID'], $data['IdUsuario']);

                if($cursoInfo && $nivelesInfo){
                    if($inscripcion){
                        if($comentariosInfo){
                            echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => $comentariosInfo, 'inscripcion' => $inscripcion]);
                        }else{
                            echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => 'no', 'inscripcion' => $inscripcion]);
                        }
                    }else{
                        if($comentariosInfo){
                            echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => $comentariosInfo, 'inscripcion' => 'no']);
                        }else{
                            echo json_encode(['success' => true, 'curso' => $cursoInfo, 'niveles' => $nivelesInfo, 'comentarios' => 'no', 'inscripcion' => 'no']);
                        }
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

            else if($data['option'] == 5){
                $curso = new Curso();
                $validacion = $curso->crearInscripcion($data['IdUsuario'], $data['IdNivel'], $data['IdCurso'], $data['metodoPago']);
                //$validacion = $curso->borrarCurso($data['idCurso']);

                if($validacion){
                    echo json_encode(['success' => true]);
                }else{
                    echo json_encode(['success' => false]);
                }
            }else if($data['option'] == 6){
                $curso = new Curso();
                $niveles = $curso->obtenerNivelesNoInscritos($data['IdUsuario'], $data['ID']);

                if($niveles){
                    echo json_encode(['success' => true, 'niveles' => $niveles]);
                }else{
                    echo json_encode(['success' => false]);
                }
            }else if($data['option'] == 7){
                $curso = new Curso();
                $diploma = $curso->verificarDiploma($data['IdUsuario'], $data['ID']);

                if($diploma){
                    echo json_encode(['success' => true, 'diploma' => $diploma]);
                }else{
                    echo json_encode(['success' => false]);
                }
            }else if($data['option'] == 8){
                $curso = new Curso();
                $actualizar = $curso->actualizarNivel($data['IdUsuario'], $data['IdNivel']);

                if($actualizar){
                    echo json_encode(['success' => true]);
                }else{
                    echo json_encode(['success' => false]);
                }
            }else if($data['option'] == 9){
                $curso = new Curso();
                $agregarCom = $curso->crearComentario($data['Texto'], $data['Calificacion'], $data['IdUsuario'], $data['ID']);

                if($agregarCom){
                    echo json_encode(['success' => true]);
                }else{
                    echo json_encode(['success' => false]);
                }
            } 
        }
    }
}
?>