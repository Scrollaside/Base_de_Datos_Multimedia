<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="iniSesion">
        <h1>Iniciar Sesión</h1><br><br>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br><br><br>

            <button id="btn" type="button">Iniciar Sesión</button>


        <p id="errorMsg" class="error"></p>
        <a href="registro.php" class="LinkRegistro">¿No tienes cuenta? Creé una.</a>
    </div>

    <script src="js/login.js"></script>
</body>
</html>
