USE bdm;
DROP database bdm;


INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Aldo Gonzalez', 'Roger Z', 'M', '2004-06-07', 'aldo@gmail.com', '123a', NOW(), null, 3, 1),
		('Guiollermo MOrin', 'Memo', 'F', '2004-06-04', 'guille@gmail.com', '123b', NOW(), null, 2, 1),
        ('Max Leon', 'Maxi 22', 'O', '2002-01-18', 'max@gmail.com', '123c', NOW(), null, 1, 1),
        ('Alberto Ayala', 'Kezzzzzzaaaann', 'M', '2003-10-03', 'kezan@gmail.com', '123d', NOW(), null, 1, 1);

INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Admin Test', 'StudentTest', 'M', NOW(), 'correo3@correo.com', 'Pass010!', NOW(), NOW(), 3, 1) ;
INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Student Test', 'StudentTest', 'M', NOW(), 'correo1@correo.com', 'Pass010!', NOW(), NOW(), 1, 1) ;
INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Instructor Test', 'InstructorTest', 'M', NOW(), 'correo2@correo.com', 'Pass020!', NOW(), NOW(), 2, 1) ;
INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Student Test Two', 'StudentTest2', 'M', NOW(), 'correo11@correo.com', 'Pass010!', NOW(), NOW(), 1, 1) ;
INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
VALUES ('Instructor Test Two', 'InstructorTest2', 'M', NOW(), 'correo22@correo.com', 'Pass020!', NOW(), NOW(), 2, 1) ;

SELECT * FROM Usuario;


INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Programacion', 'Cursos relacionados con el desarrollo de software', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Modelado', 'Técnica de crear una imagen digital tridimensional de un objeto mediante un software CAD.	', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Web', 'Red informática.', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Dibujo', 'Forma de expresión artística que consiste en crear imágenes sobre una superficie plana mediante líneas, trazos y formas.', 1, NOW()) ;
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES ('Marketing', 'onjunto de técnicas, estrategias y procesos que una marca o empresa implementa de manera ética para crear, comunicar, intercambiar y entregar ofertas o mensajes que dan valor e interesan a clientes, audiencias, socios, proveedores y personas en general.', 1, NOW()) ;

SELECT * FROM Categoria;


INSERT INTO ReporteUsuario (Tipo, UsuarioID, CursosTotal, Total)
VALUES (1, 2, 3, 40);
INSERT INTO ReporteUsuario (Tipo, UsuarioID, CursosTotal, Total)
VALUES (2, 3, 4, 5000);
INSERT INTO ReporteUsuario (Tipo, UsuarioID, CursosTotal, Total)
VALUES (1, 4, 6, 90);
INSERT INTO ReporteUsuario (Tipo, UsuarioID, CursosTotal, Total)
VALUES (2, 5, 2, 8000);

SELECT * FROM ReporteUsuario;


-- Inserts Tabla Curso
INSERT INTO Curso (Titulo, Descripcion, Imagen, Costo, CantidadNiveles, Estado, PromedioCalificacion, FechaCreacion, CantidadVendidas, UsuarioCreador)
VALUES 
('Curso de Java', 'Aprende programación en Java desde cero', NULL, 100.00, 5, 'Activo', 4.5, NOW(), 10, 1),
('Modelado 3D', 'Introducción al modelado 3D con Blender', NULL, 150.00, 8, 'Activo', 4.2, NOW(), 15, 1),
('Desarrollo Web', 'Desarrollo web moderno con HTML, CSS y JavaScript', NULL, 80.00, 6, 'Activo', 4.7, NOW(), 20, 2),
('Dibujo Artístico', 'Técnicas avanzadas de dibujo', NULL, 90.00, 4, 'Inactivo', 3.9, NOW(), 5, 3),
('Marketing Digital', 'Estrategias de marketing digital', NULL, 120.00, 5, 'Activo', 4.0, NOW(), 12, 4),
('Python para principiantes', 'Curso básico de programación en Python', NULL, 95.00, 7, 'Activo', 4.8, NOW(), 25, 1),
('React JS', 'Desarrollo de interfaces modernas con React', NULL, 130.00, 6, 'Activo', 4.5, NOW(), 18, 2),
('Animación 3D', 'Principios básicos de animación 3D', NULL, 200.00, 10, 'Inactivo', 4.3, NOW(), 7, 3),
('SEO para principiantes', 'Posicionamiento en motores de búsqueda', NULL, 70.00, 3, 'Activo', 3.8, NOW(), 4, 4),
('Diseño UX/UI', 'Conceptos de experiencia y diseño de interfaces', NULL, 110.00, 6, 'Activo', 4.6, NOW(), 9, 2);
INSERT INTO Curso (Titulo, Descripcion, Imagen, Costo, CantidadNiveles, Estado, PromedioCalificacion, FechaCreacion, CantidadVendidas, UsuarioCreador)
VALUES ('Programacion en php', 'Conceptos de experiencia y diseño de interfaces', NULL, 30.00, 1, 'Activo', 5, NOW(), 3, 2);

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



-- Inserts Inscripcion    CHECAR; NO HACE LOS INSERTS
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
(2, 10, NOW(), NOW(), NULL, 1, 1);



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


