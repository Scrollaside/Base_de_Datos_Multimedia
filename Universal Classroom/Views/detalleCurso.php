<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del curso</title>
    <link rel="stylesheet" href="../css/estilosCurso.css">
</head>
<body>
    <h1><?= htmlspecialchars($curso['nombre_curso']) ?></h1>
    <h3>Impartido por: <?= htmlspecialchars($curso['instructor']) ?></h3>
    <p><?= htmlspecialchars($curso['descripcion']) ?></p>
    <!-- Aquí puedes agregar más detalles del curso, como precio, lecciones, etc. -->
</body>
</html>
