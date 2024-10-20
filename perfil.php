<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>    
    <link rel="stylesheet" href="css/perfil.css">    
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>

    <div class="perfilInfo">

        <div class="FotoPerfil">
            <h1>Perfil de Usuario</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/3273/3273898.png" alt="Foto de perfil">
            <input type="file" id="NewPhoto" accept="image/*" disabled>
        </div>

        <div class="Informacion">

            <form>

                <label for="name">Nombre Completo:</label>
                <input type="text" id="name" value="Daniel Uriel Max Moreno Ysiel" disabled>

                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" value="Dummy" disabled>

                <label for="gender">Género:</label>
                <select id="gender" disabled>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>

                <label for="birth">Fecha de Nacimiento:</label>
                <input type="date" id="birth" value="2024-09-16" disabled>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" value="dani.morysi@hotmail.com" disabled>

                <label for="password">Contraseña:</label>
                <input type="text" id="password" value="123.dummY" disabled>

                <label for="confirmPassword">Confirmar Contraseña:</label>
                <input type="password" id="confirmPassword" value="123+dummY" disabled>

                <div class="buttons">
                    <button type="button" id="editBtn">Editar</button>
                    <button type="button" id="saveBtn" disabled>Guardar</button>
                    <button type="button" id="cancelBtn" disabled>Cancelar</button>
                </div>

                <p id="errorMsg" style="color:green;"></p>
            </form>

        </div>
    </div>
    
    <script src="js/loadNavBar.js"></script>
    <script src="js/perfil.js"></script>

</body>
</html>