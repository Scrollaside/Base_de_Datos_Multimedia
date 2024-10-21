<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Finalización</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f0f0f0;
            padding: 40px;
        }
        .certificate-container {
            border: 15px solid #1e2b37;
            padding: 50px;
            background-color: #fff;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            position: relative;
        }
        .certificate-header {
            text-align: center;
            margin-bottom: 40px;
        }
        h1 {
            font-size: 48px;
            color: #1e2b37;
            margin: 0;
            font-weight: bold;
        }
        h2 {
            font-size: 24px;
            color: #1e2b37;
            margin-bottom: 5px;
        }
        .certificate-body {
            text-align: center;
            font-size: 18px;
            color: #333;
            line-height: 1.6;
        }
        .recipient-name {
            font-size: 36px;
            font-weight: bold;
            color: #1e2b37;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .course-title {
            font-size: 24px;
            font-style: italic;
            color: #555;
            margin: 20px 0;
        }
        .date {
            font-size: 18px;
            margin: 20px 0;
            color: #555;
        }
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .signature {
            text-align: center;
            color: #333;
        }
        .signature img {
            width: 180px;
            height: auto;
        }
        .signature p {
            margin-top: 5px;
            font-size: 16px;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 14px;
            color: #888;
        }
        .border-top {
            border-top: 2px solid #1e2b37;
            margin: 0 50px 40px;
        }
    </style>
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>

    <div class="certificate-container">
        <img class="logo" src="logo.png" alt="Logo de la Empresa">
        <div class="certificate-header">
            <h1>Certificado de Finalización</h1>
            <h2>Otorgado por el Portal de Cursos Online</h2>
        </div>
        <div class="border-top"></div>
        <div class="certificate-body">
            <p>Este certificado se otorga a</p>
            <p class="recipient-name">[Nombre del Estudiante]</p>
            <p>por haber completado satisfactoriamente el curso</p>
            <p class="course-title">"[Título del Curso]"</p>
            <p>En reconocimiento a su dedicación y esfuerzo, se emite este certificado el</p>
            <p class="date">[Fecha]</p>
        </div>
        <div class="signature-section">
            <div class="signature">
                <img src="firma.png" alt="Firma">
                <p>[Nombre del Instructor]</p>
                <p>Instructor del Curso</p>
            </div>
            <div class="signature">
                <p>_________________________</p>
                <p>[Nombre del Portal]</p>
                <p>Director del Programa</p>
            </div>
        </div>
        <div class="footer">
            <p>Certificado emitido por [Nombre del Portal] | [URL del Portal]</p>
        </div>
    </div>

    <script src="js/loadNavBar.js"></script>

</body>
</html>
