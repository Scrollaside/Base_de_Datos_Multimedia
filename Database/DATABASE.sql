-- Verificar TRIGGERS

DROP DATABASE BDM;
CREATE DATABASE BDM;
USE BDM;

CREATE TABLE Usuario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NombreCompleto VARCHAR(255),
    NombreUsuario VARCHAR(255),
    Genero CHAR,
    FechaNacimiento DATE,
    Foto MEDIUMBLOB,
    Email VARCHAR(255) UNIQUE,
    Contraseña VARCHAR(255),
    FechaRegistro DATETIME,
    FechaActualizacion DATETIME,
    TipoUsuario INT,
    Estado BOOLEAN,
    Intentos INT DEFAULT 0
);
CREATE TABLE Categoria (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Descripcion TEXT,
    Creador INT,
    Creacion DATETIME,
    FOREIGN KEY (Creador)
        REFERENCES Usuario (ID)
);
CREATE TABLE Curso (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Descripcion TEXT NOT NULL,
    Imagen MEDIUMBLOB,
    Costo DECIMAL(10 , 2 ) NOT NULL,
    CantidadNiveles INT DEFAULT 1,
    Estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    PromedioCalificacion DECIMAL(3 , 2 ) DEFAULT 0.0,
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    CantidadVendidas INT DEFAULT 0,
    UsuarioCreador INT NOT NULL,
    FOREIGN KEY (UsuarioCreador)
        REFERENCES Usuario (ID)
);
CREATE TABLE CursoCategoria (
    CursoID INT NOT NULL,
    CategoriaID INT NOT NULL,
    PRIMARY KEY (CursoID , CategoriaID),
    FOREIGN KEY (CursoID)
        REFERENCES Curso (ID)
        ON DELETE CASCADE,
    FOREIGN KEY (CategoriaID)
        REFERENCES Categoria (ID)
        ON DELETE CASCADE
);
CREATE TABLE Nivel (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Descripcion TEXT,
    Video VARCHAR(255) NOT NULL,
    Documento VARCHAR(255),
    LinkRef VARCHAR(255),
    CursoID INT,
    Costo FLOAT,
    Numero INT,
    FOREIGN KEY (CursoID)
        REFERENCES Curso (ID)
);
CREATE TABLE Inscripcion (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT,
    NivelID INT,
    CursoID INT,
    FechaInscripcion DATETIME,
    FechaAcceso DATETIME,
    FechaFinalizacion DATETIME,
    Estado BOOLEAN,
    MetodoPago BOOLEAN,
    FOREIGN KEY (UsuarioID)
        REFERENCES Usuario (ID),
    FOREIGN KEY (NivelID)
        REFERENCES Nivel (ID),
	FOREIGN KEY (CursoID)
        REFERENCES Curso (ID)
);
CREATE TABLE Comentario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    Calificacion FLOAT,
    FechaHora DATETIME,
    CursoID INT,
    UsuarioID INT,
    Estado BOOLEAN,
    FOREIGN KEY (CursoID)
        REFERENCES Curso (ID),
    FOREIGN KEY (UsuarioID)
        REFERENCES Usuario (ID)
);
CREATE TABLE Mensaje (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    FechaHora DATETIME,
    Remitente INT,
    Destinatario INT,
    NivelID INT,
    FOREIGN KEY (Remitente)
        REFERENCES Usuario (ID),
    FOREIGN KEY (Destinatario)
        REFERENCES Usuario (ID),
    FOREIGN KEY (NivelID)
        REFERENCES Nivel (ID)
);
CREATE TABLE Diploma (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    EstudianteID INT,
    CursoID INT,
    FechaFin DATETIME,
    InstructorID INT,
    FOREIGN KEY (EstudianteID)
        REFERENCES Usuario (ID),
    FOREIGN KEY (CursoID)
        REFERENCES Curso (ID),
    FOREIGN KEY (InstructorID)
        REFERENCES Usuario (ID)
);
CREATE TABLE ReporteUsuario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT,
    CursosTotal FLOAT,
    Total FLOAT,
    FOREIGN KEY (UsuarioID)
        REFERENCES Usuario (ID)
);





-- INDEX --
-- INDEX --
-- INDEX --

-- Índice en el campo Email (como es único, para búsquedas rápidas)
CREATE UNIQUE INDEX idx_Usuario_Email ON Usuario (Email);

-- Índice en el campo TipoUsuario (para consultas por tipo de usuario)
CREATE INDEX idx_Usuario_TipoUsuario ON Usuario (TipoUsuario);

-- Índice en el campo Estado (para consultas por estado del usuario)
CREATE INDEX idx_Usuario_Estado ON Usuario (Estado);

-- Índice en el campo Nombre (para búsquedas rápidas por nombre de la categoría)
CREATE INDEX idx_Categoria_Nombre ON Categoria (Nombre);

-- Índice en el campo Titulo (para búsquedas rápidas por título del curso)
CREATE INDEX idx_Curso_Titulo ON Curso (Titulo);

-- Índice en el campo Estado (para consultar cursos por estado)
CREATE INDEX idx_Curso_Estado ON Curso (Estado);






-- INSERTS --
-- INSERTS --
-- INSERTS --

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


INSERT INTO ReporteUsuario (UsuarioID, CursosTotal, Total)
VALUES (2, 3, 4000),
(3, 4, 50),
(4, 6, 90),
(6, 2, 80),
(7, 3, 4000),
(8, 4, 50),
(9, 6, 9000);

-- Inserts Tabla Curso
INSERT INTO Curso (Titulo, Descripcion, Imagen, Costo, CantidadNiveles, Estado, PromedioCalificacion, FechaCreacion, CantidadVendidas, UsuarioCreador)
VALUES 
('Curso de Java', 'Aprende programación en Java desde cero', NULL, 100.00, 3, 'Activo', 4.5, NOW(), 10, 7),
('Modelado 3D', 'Introducción al modelado 3D con Blender', NULL, 150.00, 3, 'Activo', 4.2, NOW(), 15, 7),
('Desarrollo Web', 'Desarrollo web moderno con HTML, CSS y JavaScript', NULL, 80.00, 3, 'Activo', 4.7, NOW(), 20, 7),
('Dibujo Artístico', 'Técnicas avanzadas de dibujo', NULL, 90.00, 1, 'Inactivo', 3.9, NOW(), 5, 7),
('Marketing Digital', 'Estrategias de marketing digital', NULL, 120.00, 1, 'Activo', 4.0, NOW(), 12, 7),
('Python para principiantes', 'Curso básico de programación en Python', NULL, 95.00, 1, 'Activo', 4.8, NOW(), 25, 7),
('React JS', 'Desarrollo de interfaces modernas con React', NULL, 130.00, 1, 'Activo', 4.5, NOW(), 18, 7),
('Animación 3D', 'Principios básicos de animación 3D', NULL, 200.00, 1, 'Inactivo', 4.3, NOW(), 7, 7),
('SEO para principiantes', 'Posicionamiento en motores de búsqueda', NULL, 70.00, 1, 'Activo', 3.8, NOW(), 4, 9),
('Diseño UX/UI', 'Conceptos de experiencia y diseño de interfaces', NULL, 110.00, 1, 'Activo', 4.6, NOW(), 9, 9),
('Programacion en php', 'Conceptos de experiencia y diseño de interfaces', NULL, 30.00, 1, 'Activo', 5, NOW(), 3, 9);


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
(10, 3),
(11, 3);

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
    ('Nivel 1 - Introducción marketing', 'Fundamentos del marketing digital', 'video_marketing_nivel1.mp4', NULL, NULL, 5, 90, 1),
    ('Nivel 1 - Fundamentos de Python', 'Primeros pasos con Python', 'video_python_nivel1.mp4', NULL, NULL, 6, 90, 1),
    ('Nivel 1 - React', 'Introducción a React Native', 'video_react1.mp4', NULL, NULL, 7, 90, 1),
    ('Nivel 1 - Maya', 'Introducción a los fundamentos del programa Autodesk Maya', 'video_maya1.mp4', NULL, NULL, 8, 90, 1),
    ('Nivel 1 - Introducción', 'Introducción al SEO', 'video_seo1.mp4', NULL, NULL, 9, 90, 1),
    ('Nivel 1 - Diseño', 'Introducción y conceptos básicos de la educación', 'video_diseño1.mp4', NULL, NULL, 10, 90, 1),
    ('Nivel 1 - Introducción a PHP', 'Aprende los fundamentos de PHP', 'video_php_nivel1.mp4', NULL, NULL, 11, 90, 1);

-- Inserts Inscripcion   
INSERT INTO Inscripcion (UsuarioID, NivelID, CursoID,  FechaInscripcion, FechaAcceso, FechaFinalizacion, Estado, MetodoPago)
VALUES 
(6, 1, 1, NOW(), NOW(), NULL, 1, 0),
(2, 2, 1, NOW(), NOW(), NULL, 1, 1),
(3, 3, 1, NOW(), NULL, NULL, 0, 0),
(4, 4, 2, NOW(), NULL, NULL, 1, 1),
(6, 5, 2, NOW(), NOW(), NULL, 1, 0),
(2, 6, 2, NOW(), NOW(), NULL, 1, 1),
(3, 7, 3, NOW(), NULL, NULL, 0, 0),
(4, 8, 3, NOW(), NULL, NULL, 1, 1),
(6, 9, 3, NOW(), NOW(), NULL, 1, 0),
(2, 10, 4, NOW(), NOW(), NULL, 1, 1),
(6, 11, 5, NOW(), NOW(), NULL, 1, 0),
(4, 11, 5, NOW(), NOW(), NULL, 1, 0),
(3, 11, 5, NOW(), NOW(), NULL, 1, 0);

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






-- VIEWS --
-- VIEWS --
-- VIEWS --

-- VIEW 1 PARA CURSOS MEJOR CALIFICADOS
CREATE VIEW View_MejoresCalificados AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.PromedioCalificacion DESC
LIMIT 5;


-- VIEW 2 PARA CURSOS MÁS VENDIDOS
CREATE VIEW View_MasVendidos AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.CantidadVendidas,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.CantidadVendidas DESC
LIMIT 5;

-- VIEW 3 PARA CURSOS MÁS RECIENTES
CREATE VIEW View_MasRecientes AS
SELECT 
    Curso.ID,
    Curso.Titulo,
    Curso.Descripcion,
    Curso.Imagen,
    GROUP_CONCAT(Categoria.Nombre SEPARATOR ', ') AS Categorias,
    Curso.FechaCreacion,
    Curso.PromedioCalificacion
FROM 
    Curso
JOIN 
    CursoCategoria ON Curso.ID = CursoCategoria.CursoID
JOIN 
    Categoria ON CursoCategoria.CategoriaID = Categoria.ID
WHERE 
    Curso.Estado = 'Activo'
GROUP BY 
    Curso.ID
ORDER BY 
    Curso.FechaCreacion DESC
LIMIT 5;


-- VIEW 4, REPORTE DE USUARIOS
CREATE VIEW VistaReporteUsuarios AS
SELECT 
    u.NombreUsuario AS Usuario, 
    u.NombreCompleto AS Nombre, 
    DATE_FORMAT(u.FechaRegistro, '%d-%b-%Y') AS Ingreso, 
    r.CursosTotal AS Cursos, 
    r.Total AS Total,
    u.TipoUsuario AS Tipo
FROM Usuario u
JOIN ReporteUsuario r
ON u.ID = r.UsuarioID; 


-- VIEW 5, Categorias
CREATE VIEW VistaCategorias AS
SELECT ct.Nombre, ct.Descripcion, u.NombreUsuario AS Creador,  DATE_FORMAT(ct.Creacion, '%d %b %Y, %H:%i') AS Creacion -- , ct.ID
FROM Categoria ct
JOIN Usuario u ON ct.Creador = u.ID;

-- VIEW 6
CREATE OR REPLACE VIEW VentasGeneral AS
SELECT 
    c.Titulo AS Curso, 
    COUNT(DISTINCT u.ID) AS Alumnos,
    FORMAT (AVG(n.Numero), 0) AS Promedio,
    CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS Ingresos,
    c.UsuarioCreador AS Instructor,
    DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY c.ID, cg.Nombre;

-- VIEW 7
CREATE OR REPLACE VIEW VentasPorCurso AS
SELECT 
	u.NombreCompleto AS Alumno, 
	DATE_FORMAT(i.FechaInscripcion, '%d/%m/%Y') AS Inscripcion, 
    MAX(n.Numero) AS Nivel, 
	CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS Pago,
	FORMAT (AVG(i.MetodoPago), 0) AS Forma,
    c.UsuarioCreador AS Instructor,
	DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Titulo AS Curso,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY i.ID;


-- VIEW 8
CREATE OR REPLACE VIEW GananciasTotales AS 
SELECT 
	i.MetodoPago AS FormaPago, 
	SUM(n.Costo) AS IngresosTotales, 
    c.UsuarioCreador AS Instructor,
    DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Titulo AS Curso,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY i.MetodoPago, cg.Nombre, c.Estado;


-- VIEW 10
CREATE VIEW GananciasPorCurso AS
SELECT 
	i.MetodoPago AS FormaPago, 
    CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS IngresosTotales,
	c.Titulo AS Curso,
    c.UsuarioCreador AS Instructor,
	DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY i.MetodoPago, c.Titulo;


-- VIEW 11 
CREATE OR REPLACE VIEW TotalIngresos AS
SELECT 
    c.Titulo AS Curso, 
    COUNT(DISTINCT u.ID) AS Alumnos,
    FORMAT (AVG(n.Numero), 0) AS Promedio,
    SUM(n.Costo) AS Ingresos,
    c.UsuarioCreador AS Instructor,
    DATE_FORMAT(c.FechaCreacion, '%d/%m/%Y') AS Creacion,
    cg.Nombre AS Categoria,
    c.Estado AS Estado
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
INNER JOIN CursoCategoria cc ON cc.CursoID = c.ID
INNER JOIN Categoria cg ON cg.ID = cc.CategoriaID
GROUP BY c.ID, cg.Nombre, c.Estado;


CREATE VIEW ObtenerDetalleCurso AS
SELECT
	cu.ID,
	cu.Titulo AS NombreCurso,
    u.NombreUsuario AS Creador,
    cu.Descripcion AS Descripcion,
    cu.Costo AS Precio,
    cu.PromedioCalificacion AS Rating,
    cu.Imagen AS Imagen,
    cu.CantidadNiveles AS ProgramaCurso
FROM Curso cu 
INNER JOIN Usuario u ON cu.UsuarioCreador = u.ID;
--

--
CREATE VIEW ObtenerComentariosCurso AS
SELECT
	cu.ID AS ID,
    co.ID AS IdComentario,
	u.NombreUsuario AS NombreComentario,
    co.Texto AS Comentario,
    co.FechaHora AS FechaComentario,
    co.Calificacion AS CalificacionComentario,
    co.Estado AS Estado
FROM Comentario co
INNER JOIN Usuario u ON co.UsuarioID = u.ID
INNER JOIN Curso cu ON cu.ID = co.CursoID;
--

--
CREATE VIEW ObtenerNivelesCurso AS
SELECT
	cu.ID AS ID,
    n.ID AS IdNivel,
    n.Nombre AS Nombre,
    n.Descripcion AS Descripcion,
    n.Video AS Video,
    n.Documento AS Documento,
    n.LinkRef AS Link,
    n.Costo
FROM Nivel n 
INNER JOIN Curso cu ON n.CursoID = cu.ID;
--

--
CREATE VIEW ObtenerNivelIndividual AS
SELECT
    n.ID AS IdNivel,
    n.Nombre AS Nombre,
    n.Descripcion AS Descripcion,
    n.Video AS Video,
    n.Documento AS Documento,
    n.LinkRef AS Link,
    n.Costo AS Costo
FROM Nivel n;
--

--
CREATE VIEW obtenerMensajes AS
SELECT
	n.ID AS idNivel,
    m.Texto AS Texto,
    m.FechaHora AS Fecha,
    m.Remitente AS Remitente,
    m.Destinatario AS Destinatario,
    ur.NombreUsuario AS NombreRemitente,
    ud.NombreUsuario AS NombreDestinatario
FROM Mensaje m
INNER JOIN Nivel n ON n.ID = m.NivelID
INNER JOIN Usuario ur ON ur.ID = m.Remitente
INNER JOIN Usuario ud ON ud.ID = m.Destinatario
ORDER BY 
    m.FechaHora ASC;
--

--
CREATE VIEW obtenerMiembrosCurso AS
SELECT
	i.UsuarioID AS IdUsuario,
    i.NivelID AS IdNivel,
    i.CursoID AS IdCurso,
	u.NombreUsuario AS Miembro,
    u.Foto AS FotoPerfil
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Usuario u ON u.ID = i.UsuarioID;
--

-- FUNCTIONS -- 
-- FUNCTIONS -- 
-- FUNCTIONS -- 

-- FUNCTION 1, obtener el total de ventas de un curso
DELIMITER //
CREATE FUNCTION total_ventas_curso(curso_id INT) 
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE total INT;
    SELECT SUM(CantidadVendidas) INTO total
    FROM Curso
    WHERE ID = curso_id;
    RETURN IFNULL(total, 0); -- Retorna 0 si no hay ventas
END //
DELIMITER ;

-- FUNCTION 2, obtener el número total de cursos inscritos por un usuario
DELIMITER //
CREATE FUNCTION total_cursos_inscritos(usuario_id INT) 
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE total INT;
    SELECT COUNT(*) INTO total
    FROM Inscripcion
    WHERE UsuarioID = usuario_id;
    RETURN total;
END //
DELIMITER ;

-- FUNCTION 3, reporte de ventas de cursos en un rango de fechas
DELIMITER //
CREATE FUNCTION reporte_ventas_cursos(fecha_inicio DATETIME, fecha_fin DATETIME)
RETURNS TEXT
DETERMINISTIC
BEGIN
    DECLARE reporte TEXT DEFAULT '';
    DECLARE curso_id INT;
    DECLARE curso_titulo VARCHAR(255);
    DECLARE cantidad_vendida INT;
    DECLARE ingresos DECIMAL(10,2);
    DECLARE done INT DEFAULT FALSE;

    DECLARE cur CURSOR FOR
        SELECT c.ID, c.Titulo, SUM(i.Costo) AS Ingresos, COUNT(i.ID) AS CantidadVendida
        FROM Curso c
        JOIN Inscripcion i ON c.ID = i.CursoID
        WHERE i.FechaInscripcion BETWEEN fecha_inicio AND fecha_fin
        GROUP BY c.ID
        ORDER BY ingresos DESC;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO curso_id, curso_titulo, ingresos, cantidad_vendida;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET reporte = CONCAT(reporte, 'Curso: ', curso_titulo, '\n',
                             'ID del Curso: ', curso_id, '\n',
                             'Cantidad Vendida: ', cantidad_vendida, '\n',
                             'Ingresos: $', FORMAT(ingresos, 2), '\n\n');
    END LOOP;

    CLOSE cur;

    RETURN IFNULL(reporte, 'No se encontraron ventas en este periodo.');
END //
DELIMITER ;
-- uso de la función

-- FUNCTION 4
-- FUNCTION 5
-- FUNCTION 6
-- FUNCTION 7
-- FUNCTION 8






-- TRIGGERS --
-- TRIGGERS --
-- TRIGGERS --
DELIMITER //
CREATE TRIGGER bloquear_eliminacion_curso
BEFORE DELETE ON Curso
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM Inscripcion WHERE NivelID = OLD.ID AND Estado = 1) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar un curso con estudiantes inscritos.';
    END IF;
END //
DELIMITER ;
DELIMITER //
CREATE TRIGGER Generar_Diploma
AFTER UPDATE ON Inscripcion
FOR EACH ROW
BEGIN
    -- Declaración de variables
    DECLARE curso_id INT;
    DECLARE total_niveles INT;
    DECLARE niveles_completados INT;

    -- Verificar si el estado cambió de 0 a 1 (curso completado)
    IF NEW.Estado = 1 AND OLD.Estado = 0 THEN
        -- Obtener el curso asociado al nivel actualizado
        SELECT CursoID INTO curso_id
        FROM Nivel
        WHERE ID = NEW.NivelID;

        -- Contar cuántos niveles tiene el curso
        SELECT COUNT(*) INTO total_niveles
        FROM Nivel
        WHERE CursoID = curso_id;

        -- Contar cuántos niveles del curso están completados por el estudiante
        SELECT COUNT(*) INTO niveles_completados
        FROM Inscripcion I
        JOIN Nivel N ON I.NivelID = N.ID
        WHERE N.CursoID = curso_id AND I.UsuarioID = NEW.UsuarioID AND I.Estado = 1;

        -- Verificar si todos los niveles están completados
        IF niveles_completados = total_niveles THEN
            -- Insertar un diploma en la tabla Diploma
            INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
            VALUES (
                NEW.UsuarioID,  -- ID del estudiante
                curso_id,       -- ID del curso
                NOW(),          -- Fecha actual
                (SELECT UsuarioCreador FROM Curso WHERE ID = curso_id) -- Instructor del curso
            );
        END IF;
    END IF;
END//
DELIMITER ;








-- STORED PROCEDURES --
-- STORED PROCEDURES --
-- STORED PROCEDURES --

DELIMITER //

CREATE PROCEDURE ObtenerNivelesNoInscritos (
    IN p_UsuarioID INT,
    IN p_CursoID INT
)
BEGIN
    SELECT n.ID, n.Costo
    FROM Nivel n
    LEFT JOIN Inscripcion i ON n.ID = i.NivelID AND i.UsuarioID = p_UsuarioID
    WHERE i.NivelID IS NULL AND n.CursoID = p_CursoID;
END //

DELIMITER ;
-- USER SP --
-- USER SP --
DELIMITER //
CREATE PROCEDURE agregarInscripcion (
	IN p_UsuarioID INT,
    IN p_NivelID INT,
    IN p_CursoID INT,
    IN p_MetodoPago BOOLEAN
)
BEGIN
	INSERT INTO Inscripcion (UsuarioID, NivelID, CursoID, FechaInscripcion, FechaAcceso, FechaFinalizacion, Estado, MetodoPago)
    VALUES (p_UsuarioID, p_NivelID, p_CursoID, NOW(), NULL, NULL, 1, p_MetodoPago);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE RegistrarUsuario (
    IN p_nombre VARCHAR(255),
    IN p_nombreUsuario VARCHAR(255), 
    IN p_genero CHAR,
    IN p_fechaNacimiento DATE,
    IN p_foto MEDIUMBLOB,
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipoUsuario INT
)
BEGIN
    INSERT INTO Usuario (NombreCompleto, NombreUsuario, Genero, FechaNacimiento, Foto, Email, Contraseña, FechaRegistro, FechaActualizacion, TipoUsuario, Estado)
    VALUES (p_nombre, p_nombreUsuario, p_genero, p_fechaNacimiento, p_foto, p_email, p_contraseña, NOW(), NOW(), p_tipoUsuario, true);
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE CambiarEstadoUsuario (
    IN p_usuarioID INT,
    IN p_estado ENUM('Activo', 'Deshabilitado')
)
BEGIN
    UPDATE Usuario
    SET Estado = p_estado
    WHERE ID = p_usuarioID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE ActualizarUsuario (
    IN p_usuarioID INT,
    IN p_nombre VARCHAR(255),
    IN p_foto VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_genero VARCHAR(1),            
    IN p_fechaNacimiento DATE 
)
BEGIN
    UPDATE Usuario
     SET NombreCompleto = p_nombre,
        Foto = p_foto,
        Email = p_email,
        Contraseña = p_contraseña,
        Genero = p_genero,         
        FechaNacimiento = p_fechaNacimiento,
        FechaActualizacion = GETDATE()   
    WHERE ID = p_usuarioID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE WrongLogin (
	IN wl_User VARCHAR(255)
)
BEGIN
	UPDATE Usuario 
		SET Intentos = Intentos + 1
	WHERE NombreUsuario = wl_User;
    
	UPDATE Usuario
		SET Estado = 0
    WHERE NombreUsuario = wl_User AND Intentos >= 3;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE ResetTry (
	IN rt_User VARCHAR(255)
)
BEGIN
	UPDATE Usuario 
		SET Intentos = 0
	WHERE NombreUsuario = rt_User;
END //
DELIMITER ;

-- ADMIN SP --
-- ADMIN SP --

DELIMITER //
CREATE PROCEDURE ReporteUsuarios (
    IN p_tipoUsuario INT
)
BEGIN
	IF p_tipoUsuario = 1 THEN
		SELECT Usuario, Nombre, Ingreso, Cursos, CONCAT(Total, '%') AS Total, Tipo FROM VistaReporteUsuarios
		WHERE Tipo = p_tipoUsuario;
    ELSEIF p_tipoUsuario = 2 THEN
		SELECT Usuario, Nombre, Ingreso, Cursos, CONCAT('$', FORMAT(Total, 2)) AS Total, Tipo FROM VistaReporteUsuarios
        WHERE Tipo = p_tipoUsuario;
	END IF;
END //
DELIMITER ;


-- STUDENT SP --
-- STUDENT SP --

DELIMITER //
CREATE PROCEDURE InscribirEstudiante (
    IN p_usuarioID INT,
    IN p_cursoID INT
)
BEGIN
    INSERT INTO Inscripcion (UsuarioID, CursoID, FechaInscripcion, Progreso, Estado)
    VALUES (p_usuarioID, p_cursoID, NOW(), 0, 'Incompleto');
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE ActualizarProgreso (
    IN p_inscripcionID INT,
    IN p_progreso DECIMAL(5,2)
)
BEGIN
    UPDATE Inscripcion
    SET Progreso = p_progreso,
        FechaFinalizacion = IF(p_progreso = 100, NOW(), FechaFinalizacion),
        Estado = IF(p_progreso = 100, 'Completo', 'Incompleto')
    WHERE ID = p_inscripcionID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE EmitirDiploma (
    IN p_estudianteID INT,
    IN p_cursoID INT
)
BEGIN
    INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
    SELECT p_estudianteID, p_cursoID, NOW(), Instructor
    FROM Curso
    WHERE ID = p_cursoID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AgregarMensaje (
    IN p_texto TEXT,
    IN p_remitente INT,
    IN p_destinatario INT,
    IN p_cursoID INT
)
BEGIN
    INSERT INTO Mensaje (Texto, FechaHora, Remitente, Destinatario, CursoID)
    VALUES (p_texto, NOW(), p_remitente, p_destinatario, p_cursoID);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE MostrarMensajes (
    IN p_remitente INT,
    IN p_destinatario INT
)
BEGIN
    SELECT Texto, FechaHora
    FROM Mensaje
    WHERE (Remitente = p_remitente AND Destinatario = p_destinatario)
       OR (Remitente = p_destinatario AND Destinatario = p_remitente)
    ORDER BY FechaHora ASC;
END //
DELIMITER ;


-- CATEGORY SP --
-- CATEGORY SP --

DELIMITER //
CREATE PROCEDURE RegistrarCategoria (
IN rc_Nombre VARCHAR(255),
IN rc_Desc TEXT,
IN rc_Creador INT
)
BEGIN
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES (rc_Nombre, rc_Desc, rc_Creador, NOW());
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE ActualizarCategorias (
IN ac_Nombre VARCHAR(255),
IN ac_Desc TEXT,
IN ac_ID INT
)
BEGIN
DECLARE NameExists VARCHAR(255);
SELECT Nombre INTO NameExists FROM Categoria WHERE Nombre = ac_Nombre LIMIT 1;
IF NameExists IS NOT NULL THEN
UPDATE Categoria c
SET c.Descripcion = ac_Desc
WHERE c.Nombre = ac_Nombre;
ELSE
INSERT INTO Categoria (Nombre, Descripcion, Creador, Creacion)
VALUES (ac_Nombre, ac_Desc, ac_ID, NOW()) ;
END IF;
END //
DELIMITER ;


-- COURSE SP --
-- COURSE SP --

DELIMITER //
CREATE PROCEDURE AgregarCurso (
    IN p_titulo VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_costo DECIMAL(10,2),
    IN p_header VARCHAR(255),
    IN p_imagen VARCHAR(255),
    IN p_instructorID INT,
    IN p_categoriaID INT
)
BEGIN
    INSERT INTO Curso (Titulo, Descripcion, Costo, Header, Imagen, FechaCreacion, Instructor, CategoriaID)
    VALUES (p_titulo, p_descripcion, p_costo, p_header, p_imagen, NOW(), p_instructorID, p_categoriaID);
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE EliminarCursoLogicamente (
    IN p_cursoID INT
)
BEGIN
    UPDATE Curso
    SET Estado = 'Inactivo'
    WHERE ID = p_cursoID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE AgregarComentario (
    IN p_texto TEXT,
    IN p_calificacion DECIMAL(3,2),
    IN p_usuarioID INT,
    IN p_cursoID INT
)
BEGIN
    INSERT INTO Comentario (Texto, Calificacion, FechaHora, UsuarioID, CursoID)
    VALUES (p_texto, p_calificacion, NOW(), p_usuarioID, p_cursoID);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE MostrarCursosMejorCalificacion ()
BEGIN
    SELECT Titulo, Imagen, Calificacion
    FROM Curso
    WHERE Estado = 'Activo'
    ORDER BY Calificacion DESC
    LIMIT 10;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE MostrarNiveles (
    IN p_cursoID INT
)
BEGIN
    SELECT Nombre, Descripcion, Video, Costo
    FROM Nivel
    WHERE CursoID = p_cursoID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarCalificacionCurso (
    IN p_cursoID INT
)
BEGIN
    UPDATE Curso
    SET Calificacion = (
        SELECT AVG(Calificacion)
        FROM Comentario
        WHERE CursoID = p_cursoID
    )
    WHERE ID = p_cursoID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE MostrarComentarios (
    IN p_cursoID INT
)
BEGIN
    SELECT Texto, Calificacion, FechaHora, UsuarioID
    FROM Comentario
    WHERE CursoID = p_cursoID;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE BuscarCursos (
    IN p_palabraClave VARCHAR(255),
    IN p_categoriaID INT,
    IN p_rangoFechaInicio DATETIME,
    IN p_rangoFechaFin DATETIME
)
BEGIN
    SELECT Titulo, Imagen, Costo, FechaCreacion
    FROM Curso
    WHERE Estado = 'Activo'
    AND (Titulo LIKE CONCAT('%', p_palabraClave, '%') OR p_palabraClave IS NULL)
    AND (CategoriaID = p_categoriaID OR p_categoriaID IS NULL)
    AND (FechaCreacion BETWEEN p_rangoFechaInicio AND p_rangoFechaFin OR p_rangoFechaInicio IS NULL OR p_rangoFechaFin IS NULL)
    ORDER BY FechaCreacion DESC;
END //
DELIMITER ;


-- SELLS SP --
-- SELLS SP --

DELIMITER //
CREATE PROCEDURE VentasGeneralSP(
IN vg_ID INT,
IN vg_desde VARCHAR(255),
IN vg_hasta VARCHAR(255),
IN vg_categoria VARCHAR(255),
IN vg_estado VARCHAR(255)
)
BEGIN 
IF vg_categoria = 'Todas' AND vg_estado != 'Todos' THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Estado = vg_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
	GROUP BY Curso;
ELSEIF vg_estado = 'Todos' AND vg_categoria != 'Todas'THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
	GROUP BY Curso;
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
    WHERE Instructor = vg_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
    GROUP BY Curso;
ELSE 
	SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral 
	WHERE Instructor = vg_ID 
		AND Estado = vg_estado 
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y')
    GROUP BY Curso;
END IF;
END //
DELIMITER ;DELIMITER //
CREATE PROCEDURE GananciasTotalesSP(
IN gt_ID INT,
IN gt_desde VARCHAR(255),
IN gt_hasta VARCHAR(255),
IN gt_categoria VARCHAR(255),
IN gt_estado VARCHAR(255)
)
BEGIN
IF gt_categoria = 'Todas' AND gt_estado != 'Todos' THEN
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM (
	SELECT Curso, FormaPago, IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Estado = gt_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY Curso, FormaPago
    ) AS Subquery
    GROUP BY FormaPago;
ELSEIF gt_categoria != 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY FormaPago;
ELSEIF gt_categoria = 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM (
	SELECT Curso, FormaPago, IngresosTotales FROM GananciasTotales
    WHERE Instructor = gt_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
    GROUP BY Curso, FormaPago
    ) AS Subquery
    GROUP BY FormaPago;
ELSE 
	SELECT FormaPago, CONCAT('$', FORMAT(SUM(IngresosTotales), 2)) AS IngresosTotales FROM GananciasTotales
	WHERE Instructor = gt_ID 
		AND Estado = gt_estado 
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y')
	GROUP BY FormaPago, Categoria;
END IF;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE VentasPorCursoSP(
IN vg_ID INT,
IN vg_curso VARCHAR(255),
IN vg_desde VARCHAR(255),
IN vg_hasta VARCHAR(255),
IN vg_categoria VARCHAR(255),
IN vg_estado VARCHAR(255)
)
BEGIN 
IF vg_categoria = 'Todas' AND vg_estado != 'Todos' THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
	WHERE Instructor = vg_ID AND vg_curso = Curso
		AND Estado = vg_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_estado = 'Todos' AND vg_categoria != 'Todas'THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
	WHERE Instructor = vg_ID AND vg_curso = Curso
		AND Categoria = vg_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso
    WHERE Instructor = vg_ID AND vg_curso = Curso
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
ELSE 
	SELECT Alumno, Inscripcion, Nivel, Pago, Forma FROM VentasPorCurso 
	WHERE Instructor = vg_ID AND vg_curso = Curso
    AND Estado = vg_estado 
    AND Categoria = vg_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(vg_desde, '%d/%m/%Y') AND STR_TO_DATE(vg_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;
DELIMITER //
CREATE PROCEDURE GananciasPorCursoSP(
IN gt_ID INT,
IN gt_curso VARCHAR(255),
IN gt_desde VARCHAR(255),
IN gt_hasta VARCHAR(255),
IN gt_categoria VARCHAR(255),
IN gt_estado VARCHAR(255)
)
BEGIN
IF gt_categoria = 'Todas' AND gt_estado != 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
		AND Estado = gt_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_estado = 'Todos' AND gt_categoria != 'Todas'THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
		AND Categoria = gt_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSEIF gt_categoria = 'Todas' AND gt_estado = 'Todos' THEN
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
    WHERE Instructor = gt_ID AND Curso = gt_curso
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
ELSE 
	SELECT FormaPago, IngresosTotales FROM GananciasPorCurso
	WHERE Instructor = gt_ID AND Curso = gt_curso
    AND Estado = gt_estado 
    AND Categoria = gt_categoria 
    AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(gt_desde, '%d/%m/%Y') AND STR_TO_DATE(gt_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;
DELIMITER // 
CREATE PROCEDURE TotalIngresos1SP(
IN ti_ID INT,
IN ti_desde VARCHAR(255),
IN ti_hasta VARCHAR(255),
IN ti_categoria VARCHAR(255),
IN ti_estado VARCHAR(255)
)
BEGIN 
IF ti_categoria = 'Todas' AND ti_estado != 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM (
	SELECT Curso, Ingresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Estado = ti_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y')
	GROUP BY Curso
        ) AS Subquery;
ELSEIF ti_categoria != 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria = 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM (
	SELECT Curso, Ingresos FROM TotalIngresos 
    WHERE Instructor = ti_ID 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y')
	GROUP BY Curso
        ) AS Subquery;
ELSE 
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID 
		AND Estado = ti_estado 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;
DELIMITER // 
CREATE PROCEDURE TotalIngresos2SP(
IN ti_ID INT,
IN ti_curso VARCHAR(255),
IN ti_desde VARCHAR(255),
IN ti_hasta VARCHAR(255),
IN ti_categoria VARCHAR(255),
IN ti_estado VARCHAR(255)
)
BEGIN 
IF ti_categoria = 'Todas' AND ti_estado != 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Estado = ti_estado 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria != 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSEIF ti_categoria = 'Todas' AND ti_estado = 'Todos' THEN
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
    WHERE Instructor = ti_ID AND Curso = ti_curso
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
ELSE 
	SELECT CONCAT('$', FORMAT(SUM(Ingresos), 2)) AS TotalIngresos FROM TotalIngresos 
	WHERE Instructor = ti_ID AND Curso = ti_curso
		AND Estado = ti_estado 
		AND Categoria = ti_categoria 
		AND STR_TO_DATE(Creacion, '%d/%m/%Y') BETWEEN STR_TO_DATE(ti_desde, '%d/%m/%Y') AND STR_TO_DATE(ti_hasta, '%d/%m/%Y');
END IF;
END //
DELIMITER ;


-- CHAT SP --
-- CHAT SP --

DELIMITER //
CREATE PROCEDURE mandarMensaje (
    IN p_texto TEXT,
    IN p_remitenteID INT,
    IN p_destinatarioID INT,
    IN p_nivelID INT
)
BEGIN
    INSERT INTO Mensaje (Texto, FechaHora, Remitente, Destinatario, NivelID)
    VALUES (p_texto, NOW(), p_remitenteID, p_destinatarioID, p_nivelID);
END //
DELIMITER ;


-- DIPLOMA SP --
-- DIPLOMA SP --

DELIMITER //
CREATE PROCEDURE VerificarDiploma (
    IN usuario_id INT,
    IN nivel_id INT
)
BEGIN
    DECLARE curso_id INT;
    DECLARE total_niveles INT;
    DECLARE niveles_completados INT;

    -- Obtener el curso asociado al nivel actualizado
    SELECT CursoID INTO curso_id
    FROM Nivel
    WHERE ID = nivel_id;

    -- Contar cuántos niveles tiene el curso
    SELECT COUNT(*) INTO total_niveles
    FROM Nivel
    WHERE CursoID = curso_id;

    -- Contar cuántos niveles del curso están completados por el estudiante
    SELECT COUNT(*) INTO niveles_completados
    FROM Inscripcion I
    JOIN Nivel N ON I.NivelID = N.ID
    WHERE N.CursoID = curso_id AND I.UsuarioID = usuario_id AND I.Estado = 1;

    -- Verificar si todos los niveles están completados
    IF niveles_completados = total_niveles THEN
        -- Insertar un diploma en la tabla Diploma
        INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
        VALUES (
            usuario_id,  -- ID del estudiante
            curso_id,    -- ID del curso
            NOW(),       -- Fecha actual
            (SELECT UsuarioCreador FROM Curso WHERE ID = curso_id) -- Instructor del curso
        );
    END IF;
END//
DELIMITER ;