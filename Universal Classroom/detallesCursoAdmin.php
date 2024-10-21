<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/NavBar.css">
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/e43020caa8.js" crossorigin="anonymous"></script>
    <!--Iconos-->

    <script
      src="https://www.paypal.com/sdk/js?client-id=AfkKBkO84vB4KXOc0lx4pBZPESXFsEXSM6y0BQEV3dd0Da6PUExUxHiJjAO1_Mc5RwrnPop7a7Tt9Gh_&currency=MXN"
      data-sdk-integration-source="developer-studio"
    ></script>

    <link rel="stylesheet" href="../css/estilosBtnNavbar.css">
    <link rel="stylesheet" href="../css/estilosCurso.css">
    <title>Detalles del curso</title>
</head>

<body>
    <!--Boton de navbar-->
    <div class="content">
        <div class="options">
            <div class="cursos">
                <div class="item" id="item">
                    Cursos
                    <i class="fa-solid fa-chevron-down" style="color: #000000;"></i>
                </div>
                <ul class="dropContent desactivado" id="cuadro">
                    <div class="dropContent-container cursos">
                        <div class="dropContent-section cursos">
                            <div class="row align-items-start">
                                <div class="col" style="margin: 5px 100px 5px 10px;">
                                    <a class="enlace" href="cursos.php">
                                        <img src="../img/pc.png" alt="Pc" height="20px" width="20px">
                                        <span>Curso uno</span>
                                    </a>
                                </div>
                                <div class="col" style="margin: 5px 100px 5px 10px;">
                                    <a class="enlace" href="cursos.php">
                                        <img src="../img/pc.png" alt="Pc" height="20px" width="20px">
                                        <span>Curso dos</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row align-items-start">
                                <div class="col" style="margin: 5px 100px 5px 10px;">
                                    <a class="enlace" href="cursos.php">
                                        <img src="../img/pc.png" alt="Pc" height="20px" width="20px">
                                        <span>Curso tres</span>
                                    </a>
                                </div>
                                <div class="col" style="margin: 5px 100px 5px 10px;">
                                    <a class="enlace" href="cursos.php">
                                        <img src="../img/pc.png" alt="Pc" height="20px" width="20px">
                                        <span>Curso cuatro</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <!--Boton de navbar-->

    <!--Contenido general-->
    <div class="contenido-detalles">
        <div class="contenido-detalles-main">
            <div class="row">
                <!--Cuadro para la descripcion del curso, valoraciones, video, etc-->
                <div class="columna-detalles">
                    <h1 class="web">Nombre del curso</h1>
                    <p></p>
                    <p>
                        Descripción detallada del curso
                    </p>
                    <p></p>
                    <div class="estadisticas">
                        <div class="valoracion">
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <span class="puntuacion">4.8</span>
                            <div>
                                <a href="" class="view">opiniones</a>
                            </div>
                        </div>
                        <div class="otro">
                            <i class="fa-solid fa-heart" style="color: #dd3131;"></i>
                            <span>Curso gratis</span>
                        </div>
                    </div>
                </div>
                <div class="columna-detalles">
                    <div class="video">
                        <div class="youtube" data-id="">
                            <img class="player" src="" alt="">
                            <img class="play_y" src="../img/cursoHtml.jpg" alt="" width="56px" height="56px" loading="lazy">
                        </div>
                    </div>
                    <button class="ir-curso" id="a">Ir al curso</button>
                    <!-- Modal -->
                    <div class="modal-overlay" id="modalOverlay">
                        <div class="modal">
                            <h2>Opciones de acceso al curso</h2>
                            
                            <!-- Opción de acceso gratuito -->
                            <div class="option" id="freeAccess">
                                <h3>Acceso Gratuito</h3>
                                <p>Obtén acceso completo al curso de manera gratuita.</p>
                                <button>Acceder al curso</button>
                            </div>
                
                            <!-- Opción de curso de pago -->
                            <div class="option" id="paidAccess">
                                <h3>Curso de Pago</h3>
                                <p>Precio: $49.99 USD</p>
                                <p>Elige tu método de pago:</p>
                                <button id="payWithCard">Pagar con Tarjeta</button>
                                <button id="payWithPaypal">Pagar con PayPal</button>
                            </div>
                            
                            <!-- Botón para cerrar el modal -->
                            <button class="close-btn" id="closeModalBtn">Cerrar</button>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
                <!--Cuadro para la descripcion del curso, valoraciones, video, etc-->
            </div>
        </div>
    </div>
    <!--Contenido general-->

    <!--Que aprenderas-->
    <div class="contenido-aprender">
        <h2>¿Qué aprenderás?</h2>
        <div class="row">
            <div class="columna-detalles">
                <p></p>
                <p>Al finalizar este curso... podrás</p>
                <ul>
                    <li><strong>Objetivo 1. </strong>Dominar el uso...</li>
                    <li><strong>Objetivo 2. </strong>Dominar el uso...</li>
                    <li><strong>Objetivo 3. </strong>Dominar el uso...</li>
                </ul>
                <p></p>
            </div>
            <div class="columna-detalles">
                <ul class="mas">
                    <li>
                        <img src="../img/reloj.png" alt="reloj" width="23" height="23" loading="lazy">
                        <h4><strong>7 semanas estimadas</strong><br>1 - 2 horas por semana</h4>
                    </li>
                    <li>
                        <img src="../img/play.png" alt="play" width="23" height="23" loading="lazy">
                        <h4><strong>Video clases</strong><br>Aprende a través de videos explicativos y lecturas concretas</h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--Que aprenderas-->

    <!--Programa del curso-->
    <div class="contenido-programa">
        <h2>Programa del curso</h2>
        <div class="contenido-programa-unidades">
            <!--Unidad individual-->
            <div class="tab">
                <input type="checkbox" id="tab-1">
                <label for="tab-1">
                    <h4>Nivel 1. Introduccion</h4>
                </label>
            </div>
            <!--Unidad individual-->

            <!--Unidad individual-->
            <div class="tab">
                <input type="checkbox" id="tab-2">
                <label for="tab-2">
                    <h4>Nivel 2. Primer tema</h4>
                </label>
            </div>
            <!--Unidad individual-->
        </div>
    </div>
    <!--Programa del curso-->

    <!--Comentarios del curso-->
    <div class="contenido-comentarios">
        <h2>Valoración de los estudiantes</h2>
        <div class="row">
            <div class="columna-detalles">
                <div class="cuadro-rating">
                    <div class="rating">
                        <div class="numero-rating">4.8</div>
                        <div class="valoracion">
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="columna-detalles">
                        <!--Barra y fila de estrellas del curso-->
                        <div class="fila-estrellas">
                            <div class="columna-detalles bar">
                                <div class="progreso">
                                    <div class="progreso bar" style="width: 92%"></div>
                                </div>
                            </div>
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <div class="porcentaje">92%</div>
                        </div>
                        <!--Barra y fila de estrellas del curso-->

                        <!--Barra y fila de estrellas del curso-->
                        <div class="fila-estrellas">
                            <div class="columna-detalles bar">
                                <div class="progreso">
                                    <div class="progreso bar" style="width: 8%"></div>
                                </div>
                            </div>
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <div class="porcentaje">8%</div>
                        </div>
                        <!--Barra y fila de estrellas del curso-->

                        <!--Barra y fila de estrellas del curso-->
                        <div class="fila-estrellas">
                            <div class="columna-detalles bar">
                                <div class="progreso">
                                    <div class="progreso bar" style="width: 0%"></div>
                                </div>
                            </div>
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <div class="porcentaje">0%</div>
                        </div>
                        <!--Barra y fila de estrellas del curso-->

                        <!--Barra y fila de estrellas del curso-->
                        <div class="fila-estrellas">
                            <div class="columna-detalles bar">
                                <div class="progreso">
                                    <div class="progreso bar" style="width: 0%"></div>
                                </div>
                            </div>
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <div class="porcentaje">0%</div>
                        </div>
                        <!--Barra y fila de estrellas del curso-->

                        <!--Barra y fila de estrellas del curso-->
                        <div class="fila-estrellas">
                            <div class="columna-detalles bar">
                                <div class="progreso">
                                    <div class="progreso bar" style="width: 0%"></div>
                                </div>
                            </div>
                            <ul class="star">
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li >
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                </li>
                            </ul>
                            <div class="porcentaje">0%</div>
                        </div>
                        <!--Barra y fila de estrellas del curso-->
                    </div>
                </div>
            </div>
        </div>
        <ul class="lista-comentarios" id="lista-comentarios">
            <li class="fila-comentario" name="user-comment">
                <a href="" class="user">
                    <img src="../img/user.png" alt="Foto-usuario" width="56" height="56" loading="lazy">
                </a>
                <div>
                    <a href="">Nombre de un usuario</a>
                    <div class="valoracion">
                        <ul class="star">
                            <li>
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            </li>
                            <li >
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                            </li>
                        </ul>
                        <div class="fecha-comentario">Hace 2 semanas
                        </div>
                        <div class="fecha-comentario"><button id="opcion-admin">Eliminar comentario</button></div>
                    </div>
                    <p class="informacion-comentario">Muy buen curso!</p>
                </div>
            </li>
        </ul>
    </div>
    <!--Comentarios del curso-->

    <div class="modal" id="myModal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Acceso al curso
            <div class="purchase-options">
                <p>¿Desea comprar el curso completo o niveles individuales?</p>
                <label class="custom-checkbox">
                    <input type="checkbox" id="fullCourseCheckbox"> Comprar curso completo
                    <span class="checkmark"></span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" id="individualLevelsCheckbox" onclick="toggleLevelOptions()"> Comprar niveles individuales
                    <span class="checkmark"></span>
                </label>
    
                <!-- Opciones de niveles individuales que se mostrarán al seleccionar "Niveles individuales" -->
                <div id="levelOptions" style="display: none; margin-top: 10px;">
                    <label for="levelSelect">Elige el nivel:</label>
                    <select id="levelSelect">
                        <option value="1">Nivel 1</option>
                        <option value="2">Nivel 2</option>
                    </select>
                </div>
            </div>
          </h2>
          <div class="modal-options">
            <div class="option">
              <h3>Acceso gratuito</h3>
              <p>Este cuadro aparecera cuando sea un curso gratis.</p>
              <button id="freeAccessBtn">Ir al curso</button>
            </div>
            <div class="option">
              <h3>Curso de pago</h3>
              <p>Aqui aparecera si es un nivel o todo el curso. Precio: $50 (cambiara segun la seleccion)</p>
              <div id="paypal-button-container"></div>
            </div>
          </div>
        </div>
      </div>
      

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../js/estiloBotones.js"></script>
<script src="../js/paypal.js"></script>
<script src="js/loadNavBar.js"></script>
</html>