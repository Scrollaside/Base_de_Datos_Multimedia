<?php
session_start();
require_once __DIR__ . '/config.php'; // Asegúrate de que config.php está cargado aquí
require_once PROJECT_ROOT . '/Controllers/DiplomaController.php';

// Verifica si el usuario ha iniciado sesión y obtiene su ID
if (isset($_SESSION['ID'])) {
    $usuarioID = $_SESSION['ID'];

    // Crea una instancia del controlador y obtiene los diplomas
    $diplomaController = new DiplomaController();
    $diplomas = $diplomaController->mostrarDiplomas($usuarioID);
} else {
    // Redirecciona o muestra un mensaje si no está logueado
    die("Por favor, inicie sesión para ver su certificado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Finalización</title>
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/certificado.css">

</head>
<body>
    <?php if (!empty($diplomas)): ?>
        <?php foreach ($diplomas as $diploma): ?>
            <div class="certificate-container">
                <img class="logo" src="img/logo.png" alt="Logo de la Empresa">
                <div class="certificate-header">
                    <h1>Certificado de Finalización</h1>
                    <h2>Otorgado por Universal Classroom</h2>
                </div>
                <div class="border-top"></div>
                <div class="certificate-body">
                    <p>Este certificado se otorga a</p>
                    <p class="recipient-name"><?= htmlspecialchars($diploma['NombreEstudiante']) ?></p>
                    <p>por haber completado satisfactoriamente el curso</p>
                    <p class="course-title">"<?= htmlspecialchars($diploma['TituloCurso']) ?>"</p>
                    <p>En reconocimiento a su dedicación y esfuerzo, se emite este certificado el</p>
                    <p class="date"><?= date("d-m-Y", strtotime($diploma['FechaFin'])) ?></p>
                </div>
                <div class="signature-section">
                    <div class="signature">
                        <img src="img/firma1.png" alt="Firma">
                        <p><?= htmlspecialchars($diploma['NombreInstructor']) ?></p>
                        <p>Instructor del Curso</p>
                    </div>
                    <div class="signature">
                    <img src="img/firma2.jpg" alt="Firma">
                        <p>Universal Classroom</p>
                        <p>Director del Programa</p>
                    </div>
                </div>
                <div class="footer">
                    <p>Certificado emitido por Universal Classroom | https://Universal%20Classroom.com</p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No se encontraron diplomas para este usuario.</p>
    <?php endif; ?>
</body>
</html>

<script src="js/loadNavBar.js"></script>