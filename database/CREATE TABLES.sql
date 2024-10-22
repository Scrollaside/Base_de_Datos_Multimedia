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
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Descripcion TEXT NOT NULL,
    Imagen VARCHAR(255),
    Costo DECIMAL(10, 2) NOT NULL,
    CantidadNiveles INT DEFAULT 1,
    Estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    PromedioCalificacion DECIMAL(3, 2) DEFAULT 0.0,
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    UsuarioCreador INT NOT NULL,
    FOREIGN KEY (UsuarioCreador) REFERENCES Usuario(ID)
);
CREATE TABLE CursoCategoria (
    CursoID INT NOT NULL,
    CategoriaID INT NOT NULL,
    PRIMARY KEY (CursoID, CategoriaID),
    FOREIGN KEY (CursoID) REFERENCES Curso(ID) ON DELETE CASCADE,
    FOREIGN KEY (CategoriaID) REFERENCES Categoria(ID) ON DELETE CASCADE
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


