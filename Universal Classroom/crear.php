<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="css/crearCurso.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>

    <div class="contenido">

        <h1 align="center">Crear Nuevo Curso</h1>
        <form id="crear-curso-form" enctype="multipart/form-data" method="POST" action="procesarCurso.php">
            <label for="titulo">Título del Curso:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="imagen">Imagen del Curso:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <label for="presentacion">Acerca del Curso:</label>
            <textarea id="presentacion" name="presentacion" rows="5" required></textarea>

            <label for="categorias">Categorías:</label>
            <div class="categorias-options">
                <select id="categorias" name="categorias">
                    <?php
                    require_once 'config.php';
                    require_once 'Controllers/database.php';

                    $conexion = new db();
                    $query = "SELECT ID, Nombre FROM Categoria";
                    $stmt = $conexion->conectar()->query($query);

                    while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$categoria['ID']}'>{$categoria['Nombre']}</option>";
                    }
                    ?>
                </select>
                <button type="button" id="agregar-categoria">Agregar</button>
                <div id="categorias-seleccionadas"></div>
            </div>

            <label for="costo">Costo total del Curso:</label>
            <input type="number" id="costo" name="costo" required>

            <label for="niveles">Número de Niveles:</label>
            <input type="number" id="niveles" name="niveles" min="1" max="9" maxlength="1" required>

            <button type="submit">Crear Curso</button>
        </form>    

    </div>

    <script src="js/crearCurso.js"></script>
    <script src="js/loadNavBar.js"></script>
</body>
</html>
