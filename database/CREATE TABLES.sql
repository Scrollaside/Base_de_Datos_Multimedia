CREATE DATABASE BDM;
USE BDM;


ALTER TABLE Usuario MODIFY COLUMN Foto MEDIUMBLOB;
ALTER TABLE Usuario ADD NombreUsuario VARCHAR(255) NOT NULL AFTER NombreCompleto;


SELECT * FROM Usuario;

DROP TABLE ReporteUsuario;
DROP TABLE Diploma;
DROP TABLE Mensaje;
DROP TABLE Comentario;
DROP TABLE Inscripcion;
DROP TABLE Nivel;
DROP TABLE Curso;
DROP TABLE Categoria;
DROP TABLE Usuario;

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
    Estado BOOLEAN
);
CREATE TABLE Categoria (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Descripcion TEXT,
    Creador INT,
    Creacion DATETIME,
    FOREIGN KEY (Creador) REFERENCES Usuario(ID)
);
CREATE TABLE Curso (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Titulo VARCHAR(255),
    Descripcion TEXT,
    Costo FLOAT,
    Header VARCHAR(255),
    Calificacion FLOAT,
    FechaCreacion DATETIME,
    Instructor INT,
    Imagen VARCHAR(255),
    CategoriaID INT,
    FOREIGN KEY (Instructor) REFERENCES Usuario(ID),
    FOREIGN KEY (CategoriaID) REFERENCES Categoria(ID)
);
CREATE TABLE Nivel (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Descripcion TEXT,
    Video VARCHAR(255),
    CursoID INT,
    Costo FLOAT,
    FOREIGN KEY (CursoID) REFERENCES Curso(ID)
);
CREATE TABLE Inscripcion (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT,
    CursoID INT,
    FechaInscripcion DATETIME,
    Progreso FLOAT,
    FechaFinalizacion DATETIME,
    Estado BOOLEAN,
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID),
    FOREIGN KEY (CursoID) REFERENCES Curso(ID)
);
CREATE TABLE Comentario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    Calificacion FLOAT,
    FechaHora DATETIME,
    CursoID INT,
    UsuarioID INT,
    FOREIGN KEY (CursoID) REFERENCES Curso(ID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID)
);
CREATE TABLE Mensaje (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    FechaHora DATETIME,
    Remitente INT,
    Destinatario INT,
    CursoID INT,
    FOREIGN KEY (Remitente) REFERENCES Usuario(ID),
    FOREIGN KEY (Destinatario) REFERENCES Usuario(ID),
    FOREIGN KEY (CursoID) REFERENCES Curso(ID)
);
CREATE TABLE Diploma (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    EstudianteID INT,
    CursoID INT,
    FechaFin DATETIME,
    InstructorID INT,
    FOREIGN KEY (EstudianteID) REFERENCES Usuario(ID),
    FOREIGN KEY (CursoID) REFERENCES Curso(ID),
    FOREIGN KEY (InstructorID) REFERENCES Usuario(ID)
);
CREATE TABLE ReporteUsuario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Tipo INT,
    UsuarioID INT,
    CursosTotal FLOAT,
    Total FLOAT,
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID)
);


