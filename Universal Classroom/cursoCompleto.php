<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre de curso</title>
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/e43020caa8.js" crossorigin="anonymous"></script>
    <!--Iconos-->

    <link rel="stylesheet" href="css/estilosBtnNavbar.css">
    <link rel="stylesheet" href="css/estiloCursoCompleto.css">
    <link rel="stylesheet" href="css/chatEstilos.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>
    <div class="contenedor">
        
        <!--Curso, video y temas-->
        <div class="contenedor-curso">
            <header>
                <h1 id="NombreCurso"></h1>
            </header>

            <div class="container">
                <!-- Video Principal -->
                <div class="video-container">
                    <video id="courseVideo" controls>
                    </video>
                </div>
        
                <!-- Lista de Temas -->
                <div class="topics-container">
                    <h2 id="nivelNombre"></h2>
                    <div class="contenido-programa-unidades" id="recursosNivel">
                    </div>
                </div>
            </div>
        </div>
        <!--Curso, video y temas-->

         <!--chat-->
    <div class="contenedor-mensaje">
        <div class="mensaje">
           <!-- Botón del Chat -->
            <button id="mensajeBtn" class="mensaje-button">Chat</button>
        </div>
    </div>

    <div class="wrapper" id="mensajeWindow">
        <div class="mensajes" id="mensajeWindow2">
            <div class="left">
                <ul class="people" id="miembros">
                </ul>
            </div>
            <div class="right" id="chatContenedor">
            </div>
        </div>
        </div>
    <!--chat-->
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/cursoCompletoFunciones.js"></script>
<script src="js/loadNavBar.js"></script>
<script src="js/chat.js"></script>
</html>