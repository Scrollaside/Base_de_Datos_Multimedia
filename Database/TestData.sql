USE bdm;

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

SELECT * FROM ReporteUsuario