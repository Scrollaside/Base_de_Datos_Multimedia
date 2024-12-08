<?php
session_start();
require_once __DIR__ . '/config.php';
require_once PROJECT_ROOT . '/Controllers/database.php';
require_once PROJECT_ROOT . '/Models/EdicionCurso.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Curso no especificado.";
    exit;
}

$cursoID = (int)$_GET['id'];
$db = new db();
$edicionCurso = new EdicionCurso($db);

// Obtener información del curso
$cursoInfo = $edicionCurso->obtenerInformacionCurso($cursoID);
if (!$cursoInfo) {
    echo "Curso no encontrado.";
    exit;
}

// Obtener categorías asociadas al curso
$categoriasCurso = $edicionCurso->obtenerCategoriasCurso($cursoID);

// Obtener todas las categorías disponibles
$todasCategorias = $edicionCurso->obtenerTodasLasCategorias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="css/editarCurso.css">
    <link rel="stylesheet" href="css/instructor.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>

    <h1 align="center">Información del Curso</h1>

    <div align="center">

    <div class="cursoInfo" >

        <div class="modulo-imagen">
            <img src="<?php echo htmlspecialchars($cursoInfo['Imagen']); ?>" alt="Foto de perfil" id="profilePic" class="FotoPerfil">
            <input type="file" id="NewPhoto" accept="image/*">
        </div>
                
        <button id="guardarFoto">Actualizar Imagen</button>          

    </div><br><br><br>

    <div class="cursoInfo" >

        <div class="modulo-curso">            
            <label>Título:</label>
            <input type="text" id="titulo" value="<?php echo htmlspecialchars($cursoInfo['Titulo']); ?>">
    
            <label>Descripción:</label>
            <textarea id="descripcion"><?php echo htmlspecialchars($cursoInfo['Descripcion']); ?></textarea>
    
            <label>Costo:</label>
            <input type="number" id="costo" value="<?php echo htmlspecialchars($cursoInfo['Costo']); ?>">
        </div>
                 
        <button id="guardarInfo">Guardar Cambios</button>

    </div><br><br><br>

    <div class="cursoInfo" >

        <div class="modulo-categorias">
            <h2>Categorías</h2>
            <ul id="categoriasActuales">
                <?php foreach ($categoriasCurso as $categoria) : ?>
                    <li data-id="<?php echo $categoria['ID']; ?>"><?php echo htmlspecialchars($categoria['Nombre']); ?></li>
                <?php endforeach; ?>
            </ul>
                
            <select id="nuevasCategorias">
                <?php foreach ($todasCategorias as $categoria) : ?>
                    <option value="<?php echo $categoria['ID']; ?>"><?php echo htmlspecialchars($categoria['Nombre']); ?></option>
                <?php endforeach; ?>
            </select>
            <button id="agregarCategoria">Agregar</button>
        </div>
                
        <button id="guardarCategorias">Actualizar categorias</button>

    </div><br><br><br>
  
    <p id="errorMsg" style="color:green;"></p>


    <script src="js/editarCurso.js"></script>    
    <script src="js/loadNavBar.js"></script>
</body>
</html>
