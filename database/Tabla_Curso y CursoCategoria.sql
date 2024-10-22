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
