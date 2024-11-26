<?php
// CrearCurso.php

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$titulo = $_POST['titulo'];
$presentacion = $_POST['presentacion'];
$categorias = $_POST['categorias']; 
$costo = $_POST['costo'];
$niveles = $_POST['niveles'];

// Subir la imagen (convertirla a BLOB)
$imagen = $_FILES['imagen'];
$imagen_tmp = $imagen['tmp_name'];
$imagen_error = $imagen['error'];

// Verificar si hubo un error con la carga de la imagen
if ($imagen_error === 0) {
    // Leer la imagen y convertirlo a binario
    $imagen_data = file_get_contents($imagen_tmp);

    // Preparar la consulta para insertar los datos en la base de datos
    $sql = "INSERT INTO Curso (Titulo, Descripcion, Imagen, Costo, CantidadNiveles, Categoria)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("ssbiis", $titulo, $presentacion, $imagen_data, $costo, $niveles, $categorias);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Curso creado con éxito.";
    } else {
        echo "Error al crear el curso: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Hubo un error al subir la imagen.";
}

// Cerrar la conexión
$conn->close();
?>
