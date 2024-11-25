
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
CREATE PROCEDURE ActualizarCalificacionCurso (				-- Checar storage procedure
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
