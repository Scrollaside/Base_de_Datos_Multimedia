<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nombre_basedatos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta para obtener el reporte
$sql = "
SELECT 
    c.ID AS CursoID,
    c.Titulo AS TituloCurso,
    total_ventas_curso(c.ID) AS CantidadDeVentas,
    (total_ventas_curso(c.ID) * c.Costo) AS GananciasTotales,
    c.FechaCreacion,
    c.Estado,
    GROUP_CONCAT(cat.Nombre SEPARATOR ', ') AS Categorias,
    u.Nombre AS NombreInstructor,
    c.PromedioCalificacion
FROM 
    Curso c
LEFT JOIN 
    Usuario u ON c.UsuarioCreador = u.ID
LEFT JOIN 
    CursoCategoria cc ON c.ID = cc.CursoID
LEFT JOIN 
    Categoria cat ON cc.CategoriaID = cat.ID
GROUP BY 
    c.ID
";

$result = $conn->query($sql);

// Generar tabla HTML con los datos
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>ID Curso</th>
            <th>Título</th>
            <th>Cantidad de Ventas</th>
            <th>Ganancias Totales</th>
            <th>Fecha de Creación</th>
            <th>Estado</th>
            <th>Categorías</th>
            <th>Instructor</th>
            <th>Promedio Calificaciones</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['CursoID']}</td>
                <td>{$row['TituloCurso']}</td>
                <td>{$row['CantidadDeVentas']}</td>
                <td>\${$row['GananciasTotales']}</td>
                <td>{$row['FechaCreacion']}</td>
                <td>{$row['Estado']}</td>
                <td>{$row['Categorias']}</td>
                <td>{$row['NombreInstructor']}</td>
                <td>{$row['PromedioCalificacion']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron datos.";
}

$conn->close();
?>
