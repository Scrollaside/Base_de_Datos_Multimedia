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
    <link rel="stylesheet" href="css/NavBar.css">
</head>
<body>
    <div class="contenedor">
        
        <!--Curso, video y temas-->
        <div class="contenedor-curso">
            <header>
                <h1>Curso de Programación</h1>
            </header>

            <div class="container">
                <!-- Video Principal -->
                <div class="video-container">
                    <video id="courseVideo" controls>
                        <source src="" type="video/mp4">
                        Tu navegador no soporta la etiqueta de video.
                    </video>
                </div>
        
                <!-- Lista de Temas -->
                <div class="topics-container">
                    <h2>Programa del curso</h2>
                    <div class="contenido-programa-unidades">
                        <!--Unidad individual-->
                        <div class="tab">
                            <input type="checkbox" id="tab-1">
                            <label for="tab-1">
                                <h4>Unidad 1. Conceptos básicos C++</h4>
                            </label>
                        </div>
                        <!--Unidad individual-->
            
                        <!--Unidad individual-->
                        <div class="tab">
                            <input type="checkbox" id="tab-2">
                            <label for="tab-2">
                                <h4>Unidad 2. Conceptos Básicos C#</h4>
                            </label>
                        </div>
                        <!--Unidad individual-->
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
                <div class="top">
                    <input type="text" placeholder="Search" />
                    <a href="javascript:;" class="search"></a>
                </div>
                <ul class="people">
                    <li class="person" data-chat="person1">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt="" />
                        <span class="name">Alberto</span>
                        <span class="time">2:09 PM</span>
                        <span class="preview">Me preguntaba...</span>
                    </li>
                    <li class="person" data-chat="person2">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/dog.png" alt="" />
                        <span class="name">Pedro</span>
                        <span class="time">1:44 PM</span>
                        <span class="preview">Podría ayudarme...</span>
                    </li>
                    <li class="person" data-chat="person3">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/louis-ck.jpeg" alt="" />
                        <span class="name">Luis</span>
                        <span class="time">2:09 PM</span>
                        <span class="preview">Tengo una duda...</span>
                    </li>
                </ul>
            </div>
            <div class="right">
                <div class="top"><span>To: <span class="name">Pedro</span></span></div>
                <div class="chat" data-chat="person1">
                    <div class="conversation-start">
                        <span>Today, 6:48 AM</span>
                    </div>
                    <div class="bubble you">
                        Hola,
                    </div>
                    <div class="bubble you">
                        Soy yo.
                    </div>
                    <div class="bubble you">
                        Me preguntaba...
                    </div>
                </div>
                <div class="chat" data-chat="person2">
                    <div class="conversation-start">
                        <span>Today, 5:38 PM</span>
                    </div>
                    <div class="bubble you">
                        Hola
                    </div>
                    <div class="bubble you">
                        Cómo estás?
                    </div>
                    <div class="bubble me">
                        Hola
                    </div>
                    <div class="bubble me">
                        Bien, y tú?
                    </div>
                    <div class="bubble you">
                        Bien bien, quería saber algo
                    </div>
                    <div class="bubble you">
                        Podría ayudarme con un este tema?
                    </div>
                </div>
                <div class="chat" data-chat="person3">
                    <div class="conversation-start">
                        <span>Today, 3:38 AM</span>
                    </div>
                    <div class="bubble you">
                        Hola
                    </div>
                    <div class="bubble you">
                        Estamos en el mismo grupo
                    </div>
                    <div class="bubble me">
                        Holaa
                    </div>
                    <div class="bubble me">
                        En serio?
                    </div>
                    <div class="bubble you">
                        Sii
                    </div>
                    <div class="bubble you">
                        Con el maestro Juan
                    </div>
                    <div class="bubble you">
                        Tengo una duda con el tema 2
                    </div>
                </div>
                <div class="write">
                    <a href="javascript:;" class="write-link attach"></a>
                    <input type="text" />
                    <a href="javascript:;" class="write-link smiley"></a>
                    <a href="javascript:;" class="write-link send"></a>
                </div>
            </div>
        </div>
        </div>
    <!--chat-->
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/cursoCompletoFunciones.js"></script>
<script src="js/loadNavBar.js"></script>
<script src="js/btnChat.js"></script>
<script src="js/chat.js"></script>
</html>