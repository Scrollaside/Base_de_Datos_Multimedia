<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>

    <div class="registro-container">

        <h1 align="center">Registro de Usuario</h1>

        <form id="registroForm">

            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" id="nombreCompleto" name="nombreCompleto">

            <label for="nombreUsuario">Nombre de Usuario:</label>
            <input type="text" id="nombreUsuario" name="nombreUsuario">

            <label for="genero">Género:</label>
            <select id="genero" name="genero">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>

            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento">

            <label for="foto">Imagen de Perfil:</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email">

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password">

            <label for="tipoUsuario">Rol:</label>
            <select id="tipoUsuario" name="tipoUsuario">
                <option value="Estudiante">Estudiante</option>
                <option value="Instructor">Instructor</option>
            </select>

            <button type="submit">Registrarse</button>
        </form>

        <p id="errorMsg" class="error"></p>

    </div>
    <script src="js/registro.js"></script>

</body>
</html>
