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
    Intentos TINYINT DEFAULT 0
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
    Imagen MEDIUMBLOB,    												-- Cambio de varchar a medium blob
    Costo DECIMAL(10, 2) NOT NULL,
    CantidadNiveles INT DEFAULT 1,
    Estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    PromedioCalificacion DECIMAL(3, 2) DEFAULT 0.0,
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    CantidadVendidas INT DEFAULT 0,										-- Variable agregada Sumar ventas
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
    Video VARCHAR(255) NOT NULL,
    Documento VARCHAR(255), 											
    LinkRef VARCHAR(255),												
    CursoID INT,
    Costo FLOAT,
    Numero INT,
    FOREIGN KEY (CursoID) REFERENCES Curso(ID)
);
CREATE TABLE Inscripcion (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UsuarioID INT,
    NivelID INT,
    FechaInscripcion DATETIME,			
	FechaAcceso DATETIME,	
    FechaFinalizacion DATETIME,
    Estado BOOLEAN,
    MetodoPago BOOLEAN, 												
        
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID),
    FOREIGN KEY (NivelID) REFERENCES Nivel(ID)						-- Cambiado la referencia de la compra del usuario
);
CREATE TABLE Comentario (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    Calificacion FLOAT,
    FechaHora DATETIME,
    CursoID INT,
    UsuarioID INT,
    Estado BOOLEAN,													-- Variable agregada para ver si el comentario esta borrado
    
    FOREIGN KEY (CursoID) REFERENCES Curso(ID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID)
);
CREATE TABLE Mensaje (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Texto TEXT,
    FechaHora DATETIME,
    Remitente INT,
    Destinatario INT,
    NivelID INT,
    FOREIGN KEY (Remitente) REFERENCES Usuario(ID),
    FOREIGN KEY (Destinatario) REFERENCES Usuario(ID),
    FOREIGN KEY (NivelID) REFERENCES Nivel(ID)
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
    UsuarioID INT,
    CursosTotal FLOAT,
    Total FLOAT,
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID)
);

