<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor MainPage</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link rel="stylesheet" href="css/NavBar.css">
</head>

<body>
    
    <br><h1 align="center">CURSOS IMPARTIDOS</h1>

    <div class="content">

        <div align="center">

            <!-- Curso 1 -->
            <div class="curso" id="curso1">
                <img src="https://administraciondesistemas.com/wp-content/uploads/2024/01/lenguajes-programacion-unsplash.jpg" alt="Imagen del curso">
                <div class="curso-info" align="left">
                    <h2>Curso de Programación</h2>
                    <p>Aprende a programar desde cero en C++ y C# fácil y sencillo.</p><br>

                    <div class="detalles">
                        <p>Categorías: Tecnología, Programación</p>
                        <p>Calificación: 9/10</p>
                    </div>

                    <a href="detallesCurso.php" class="curso-link">Explorar Clase</a>
                    <button class="curso-link" onclick="toggleCurso(1)">Deshabilitar Curso</button>
                </div>
            </div>

            <!-- Curso 2 -->
            <div class="curso" id="curso2">
                <img src="https://academyofanimatedart.com/wp-content/uploads/2021/12/unreal-image-1.jpg" alt="Imagen del curso" alt="Imagen del curso">
                <div class="curso-info" align="left">
                    <h2>Todo sobre Unreal Engine</h2>
                    <p>Ven y aprende todo sobre este software para ¡HACER TU PROPIO VIDEOJUEGO! Saca a lucir tus habilidades y pon a volar tu propia imaginación, aprende la interfaz, los nodos y como hacer un videojuego divertido.</p><br>

                    <div class="detalles">
                        <p>Categorías: Tecnología, Programación</p>
                        <p>Calificación: 9.9/10</p>
                    </div>

                    <a href="detallesCurso.php" class="curso-link">Explorar Clase</a>
                    <button class="curso-link" onclick="toggleCurso(2)">Deshabilitar Curso</button>
                </div>
            </div>
            
            <!-- Curso 3 -->
            <div class="curso" id="curso3">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa_EipSRfPVNEeyj6Q16qE79vugIbrS7s3YA&s" alt="Imagen del curso">
                <div class="curso-info" align="left">
                    <h2>Curso de HTML</h2>
                    <p>Aprende a realizar páginas web, ¿no sueles diseñarlas y al tan poca imaginación haces las cosas repetidas una y otra vez? ¿No te cansas de no saber que escribir para tener una página creible? ¿Te falta imaginación para saber que datos dummy poner en tus prácticas? Ven y descubre que puedes hacer, además de tips para mejorar tus proyectos.</p><br>

                    <div class="detalles">
                        <p>Categorías: Tecnología, Web</p>
                        <p>Calificación: -10/10</p>
                    </div>

                    <a href="detallesCurso.php" class="curso-link">Explorar Clase</a>
                    <button class="curso-link" onclick="toggleCurso(3)">Deshabilitar Curso</button>
                </div>
            </div>

            <!-- Curso 4 -->
            <div class="curso" id="curso4">
                <img src="https://img-c.udemycdn.com/course/750x422/5066618_1a4f.jpg" alt="Imagen del curso">
                <div class="curso-info" align="left">
                    <h2>Curso de C#</h2>
                    <p>Descubre las bases para el lenguaje C# y el uso de recursos por forms, ven y aprende de una manera fácil y divertida todos los componentes que puedes utilizar.</p><br>

                    <div class="detalles">
                        <p>Categorías: Tecnología, Programación</p>
                        <p>Calificación: 7.4/10</p>
                    </div>

                    <a href="detallesCurso.php" class="curso-link">Explorar Clase</a>
                    <button class="curso-link" onclick="toggleCurso(4)">Deshabilitar Curso</button>
                </div>
            </div>



        </div>
    </div>

    <script>
        function toggleCurso(cursoId) {
            const curso = document.getElementById(`curso${cursoId}`);
            const button = curso.querySelector('button');
            
            if (button.textContent === 'Deshabilitar Curso') {
                curso.style.opacity = '0.5';
                button.textContent = 'Habilitar Curso';
                alert('El curso ha sido deshabilitado');
            } else {
                curso.style.opacity = '1';
                button.textContent = 'Deshabilitar Curso';
                alert('El curso ha sido habilitado');
            }
        }
    </script>

<script src="js/loadNavBar.js"></script>

</body>
</html>
