USE bdm;

INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Aldo Gonzalez', 'Roger Z', 'M', '2004-06-07', 'aldo@gmail.com', '123a', NOW(), null, 3, 1),
		('Guiollermo MOrin', 'Memo', 'F', '2004-06-04', 'guille@gmail.com', '123b', NOW(), null, 2, 1),
        ('Max Leon', 'Maxi 22', 'O', '2002-01-18', 'max@gmail.com', '123c', NOW(), null, 1, 1),
        ('Alberto Ayala', 'Kezzzzzzaaaann', 'M', '2003-10-03', 'kezan@gmail.com', '123d', NOW(), null, 1, 1);

INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Admin Test', 'AdminTest', 'M', NOW(), 'correo3@correo.com', 'Pass010!', NOW(), NOW(), 3, 1),
('Student Test', 'StudentTest', 'M', NOW(), 'correo1@correo.com', 'Pass010!', NOW(), NOW(), 1, 1),
('Instructor Test', 'InstructorTest', 'M', NOW(), 'correo2@correo.com', 'Pass020!', NOW(), NOW(), 2, 1),
('Student Test Two', 'StudentTest2', 'M', NOW(), 'correo11@correo.com', 'Pass010!', NOW(), NOW(), 1, 1),
('Instructor Test Two', 'InstructorTest2', 'M', NOW(), 'correo22@correo.com', 'Pass020!', NOW(), NOW(), 2, 1) ;

SELECT * FROM usuario;

INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Programacion', 'Cursos relacionados con el desarrollo de software', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Modelado', 'Técnica de crear una imagen digital tridimensional de un objeto mediante un software CAD.	', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Web', 'Red informática.', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Dibujo', 'Forma de expresión artística que consiste en crear imágenes sobre una superficie plana mediante líneas, trazos y formas.', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Marketing', 'Conjunto de técnicas, estrategias y procesos que una marca o empresa implementa de manera ética para crear, comunicar, intercambiar y entregar ofertas o mensajes que dan valor e interesan a clientes, audiencias, socios, proveedores y personas en general.', 1, NOW()) ;

SELECT * FROM Categoria;


INSERT INTO ReporteUsuario (UsuarioID, CursosTotal, Total)
VALUES (2, 3, 4000),
(3, 4, 50),
(4, 6, 90),
(6, 2, 80),
(7, 3, 4000),
(8, 4, 50),
(9, 6, 9000);

SELECT * FROM ReporteUsuario;


-- Inserts Tabla Curso
INSERT INTO Curso (Titulo, Descripcion, Imagen, Costo, CantidadNiveles, Estado, PromedioCalificacion, FechaCreacion, CantidadVendidas, UsuarioCreador)
VALUES 
('Curso de Java', 'Aprende programación en Java desde cero', NULL, 100.00, 5, 'Activo', 4.5, NOW(), 10, 3),
('Modelado 3D', 'Introducción al modelado 3D con Blender', NULL, 150.00, 8, 'Activo', 4.2, NOW(), 15, 3),
('Desarrollo Web', 'Desarrollo web moderno con HTML, CSS y JavaScript', NULL, 80.00, 6, 'Activo', 4.7, NOW(), 20, 3),
('Dibujo Artístico', 'Técnicas avanzadas de dibujo', NULL, 90.00, 4, 'Inactivo', 3.9, NOW(), 5, 3),
('Marketing Digital', 'Estrategias de marketing digital', NULL, 120.00, 5, 'Activo', 4.0, NOW(), 12, 3),
('Python para principiantes', 'Curso básico de programación en Python', NULL, 95.00, 7, 'Activo', 4.8, NOW(), 25, 3),
('React JS', 'Desarrollo de interfaces modernas con React', NULL, 130.00, 6, 'Activo', 4.5, NOW(), 18, 3),
('Animación 3D', 'Principios básicos de animación 3D', NULL, 200.00, 10, 'Inactivo', 4.3, NOW(), 7, 3),
('SEO para principiantes', 'Posicionamiento en motores de búsqueda', NULL, 70.00, 3, 'Activo', 3.8, NOW(), 4, 5),
('Diseño UX/UI', 'Conceptos de experiencia y diseño de interfaces', NULL, 110.00, 6, 'Activo', 4.6, NOW(), 9, 5),
('Programacion en php', 'Conceptos de experiencia y diseño de interfaces', NULL, 30.00, 1, 'Activo', 5, NOW(), 3, 5);

SELECT * FROM curso;

-- Inserts Tabla CursoCategoria
INSERT INTO CursoCategoria (CursoID, CategoriaID)
VALUES 
(1, 1), (1, 3),
(2, 2),
(3, 3), (3, 1),
(4, 4),
(5, 5),
(6, 1),
(7, 3), (7, 5),
(8, 2),
(9, 5), (9, 1),
(10, 3);


-- Inserts Tabla Nivel
INSERT INTO Nivel (Nombre, Descripcion, Video, Documento, LinkRef, CursoID, Costo, Numero)
VALUES
    ('Nivel 1 - Introducción a Java', 'Introducción a los fundamentos de Java', 'video_java_nivel1.mp4', NULL, NULL, 1, 120, 1),
    ('Nivel 2 - Fundamentos de Java', 'Profundización en conceptos básicos de Java', 'video_java_nivel2.mp4', NULL, NULL, 1, 120, 2),
    ('Nivel 3 - Programación Orientada a Objetos', 'Curso de POO con Java', 'video_java_nivel3.mp4', NULL, NULL, 1, 120, 3),
    ('Nivel 1 - Modelado Básico 3D', 'Fundamentos básicos de modelado 3D en Blender', 'video_modelado3d_nivel1.mp4', NULL, NULL, 2, 200, 1),
    ('Nivel 2 - Modelado Intermedio 3D', 'Modelado 3D con técnicas avanzadas', 'video_modelado3d_nivel2.mp4', NULL, NULL, 2, 200, 2),
    ('Nivel 3 - Renderizado 3D', 'Técnicas de renderizado en Blender', 'video_modelado3d_nivel3.mp4', NULL, NULL, 2, 200, 3),
    ('Nivel 1 - Fundamentos de Desarrollo Web', 'Aprende HTML y CSS desde cero', 'video_web_nivel1.mp4', NULL, NULL, 3, 100, 1),
    ('Nivel 2 - Desarrollo Web Interactivo', 'Inicia con JavaScript para el desarrollo web', 'video_web_nivel2.mp4', NULL, NULL, 3, 100, 2),
    ('Nivel 3 - Desarrollo Web Avanzado', 'Desarrollo de aplicaciones dinámicas con JavaScript', 'video_web_nivel3.mp4', NULL, NULL, 3, 100, 3),
    ('Nivel 1 - Dibujo Artístico Básico', 'Técnicas de dibujo para principiantes', 'video_dibujo_nivel1.mp4', NULL, NULL, 4, 170, 1),
    ('Nivel 1 - Introducción a PHP', 'Aprende los fundamentos de PHP', 'video_php_nivel1.mp4', NULL, NULL, 11, 90, 1);
SELECT * FROM Nivel;


-- Inserts Inscripcion   
INSERT INTO Inscripcion (UsuarioID, NivelID, FechaInscripcion, FechaAcceso, FechaFinalizacion, Estado, MetodoPago)
VALUES 
(1, 1, NOW(), NOW(), NULL, 1, 0),
(2, 2, NOW(), NOW(), NULL, 1, 1),
(3, 3, NOW(), NULL, NULL, 0, 0),
(4, 4, NOW(), NULL, NULL, 1, 1),
(1, 5, NOW(), NOW(), NULL, 1, 0),
(2, 6, NOW(), NOW(), NULL, 1, 1),
(3, 7, NOW(), NULL, NULL, 0, 0),
(4, 8, NOW(), NULL, NULL, 1, 1),
(1, 9, NOW(), NOW(), NULL, 1, 0),
(2, 10, NOW(), NOW(), NULL, 1, 1),
(1, 11, NOW(), NOW(), NULL, 1, 0);
SELECT * FROM Inscripcion;

-- Inserts de Comentario
INSERT INTO Comentario (Texto, Calificacion, FechaHora, CursoID, UsuarioID, Estado)
VALUES 
('Excelente curso, muy recomendado.', 5.0, NOW(), 1, 1, 1),
('Aprendí mucho sobre modelado 3D, muy bueno.', 4.0, NOW(), 2, 2, 1),
('Buen curso, pero podría mejorar en algunos aspectos.', 3.5, NOW(), 3, 3, 1),
('No me gustó, esperaba algo más avanzado.', 2.0, NOW(), 4, 4, 0),
('Información muy útil y bien explicada.', 4.8, NOW(), 5, 1, 1),
('Perfecto para principiantes, fácil de entender.', 4.5, NOW(), 6, 2, 1),
('El contenido está un poco desactualizado.', 3.0, NOW(), 7, 3, 0),
('Me gustó mucho la animación y las explicaciones.', 4.7, NOW(), 8, 4, 1),
('Excelente para entender SEO desde cero.', 4.2, NOW(), 9, 1, 1),
('Un curso muy útil para diseñadores.', 4.6, NOW(), 10, 2, 1);



-- Inserts de Diplomas
INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
VALUES 
(1, 1, NOW(), 2),
(2, 3, NOW(), 3),
(3, 5, NOW(), 1),
(4, 7, NOW(), 2),
(1, 2, NOW(), 4),
(2, 4, NOW(), 3),
(3, 6, NOW(), 2),
(4, 8, NOW(), 1),
(1, 9, NOW(), 2),
(2, 10, NOW(), 4);

SELECT * FROM Diploma;



-- Inserts Tabla Inscripcion
INSERT INTO Inscripcion (UsuarioID, NivelID, FechaInscripcion, FechaAcceso, FechaFinalizacion, Estado, MetodoPago)
VALUES
    (1, 1, NOW(), NOW(), NULL, TRUE, 0), -- Aldo Gonzalez, Nivel 1 de Java, pago con PayPal
    (1, 2, NOW(), NOW(), NULL, TRUE, 0), -- Aldo Gonzalez, Nivel 2 de Java, pago con PayPal
    (2, 3, NOW(), NOW(), NULL, TRUE, 1), -- Guillermo Morin, Nivel 3 de Web, pago con tarjeta
    (3, 5, NOW(), NOW(), NULL, TRUE, 1), -- Max Leon, Nivel 1 de 3D, pago con tarjeta
    (4, 8, NOW(), NOW(), NULL, TRUE, 0), -- Alberto Ayala, Nivel 1 de Web, pago con PayPal
    (2, 6, NOW(), NOW(), NULL, TRUE, 1), -- Guillermo Morin, Nivel 2 de 3D, pago con tarjeta
    (1, 7, NOW(), NOW(), NULL, TRUE, 0); -- Aldo Gonzalez, Nivel 3 de 3D, pago con PayPal

Select * from inscripcion;






