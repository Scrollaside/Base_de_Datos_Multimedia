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

$fotoPerfilSrc = $cursoInfo['Imagen'] ? 'data:image/jpeg;base64,' . base64_encode($cursoInfo['Imagen']) : 'https://cdn-icons-png.flaticon.com/512/3273/3273898.png';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/editarCurso.css">
</head>
<body>

    <h1 align="center">Información del Curso</h1>
    <input type="hidden" id="cursoId" value="<?php echo $cursoID; ?>">

    <div align="center">

    <div class="cursoInfo" >

        <div class="modulo-imagen">
            <img src="<?php echo $fotoPerfilSrc; ?>" alt="Foto de perfil" class="FotoPerfil" vid="profilePic">
            <input type="file" id="NewPhoto" accept="image/*">
        </div>
                
        <button id="guardarFoto">Actualizar Imagen</button>          

    </div><br><br><br>

    <div class="cursoInfo" >

        <div class="modulo-curso">            
            <label>Título:</label>
            <input type="text" id="titulo" class="FotoPerfil" value="<?php echo htmlspecialchars($cursoInfo['Titulo']); ?>">
    
            <label>Descripción:</label>
            <textarea id="descripcion"><?php echo htmlspecialchars($cursoInfo['Descripcion']); ?></textarea>
    
            <label>Costo:</label>
            <input type="number" id="costo" value="<?php echo htmlspecialchars($cursoInfo['Costo']); ?>">
        </div>
                 
        <button id="guardarInfo">Guardar Cambios</button>

    </div><br><br><br>

    <div class="cursoInfo">

        <div class="modulo-categorias">
            <label>Categorías</label>
            <!-- Lista de categorías actuales -->
            <ul id="categoriasActuales" align="left">
                <?php foreach ($categoriasCurso as $categoria) : ?>
                    <li data-id="<?php echo $categoria['ID']; ?>">
                        <?php echo htmlspecialchars($categoria['Nombre']); ?>
                        <button id="cancelBtn" class="btnEliminarCategoria">X</button>
                    </li>
                <?php endforeach; ?>
            </ul>
                    
            <!-- Select para agregar nuevas categorías -->
            <select id="selectCategorias">
                <option value="">Selecciona una categoría</option>
                <?php foreach ($todasCategorias as $categoria): ?>
                    <option value="<?= $categoria['ID'] ?>"><?= htmlspecialchars($categoria['Nombre']); ?></option>
                <?php endforeach; ?>
            </select>
            <button id="btnAgregarCategoria" class="editBtn">Agregar Categoría</button>
        </div>
                    
        <br>
        <button id="guardarCategoria">Actualizar Categorías</button>
    </div><br><br><br><br><br>

    <script src="js/editarCurso.js"></script>    
    <script src="js/loadNavBar.js"></script>
</body>
</html>
