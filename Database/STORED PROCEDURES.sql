DELIMITER //
CREATE PROCEDURE RegistrarUsuario (
    IN p_nombre VARCHAR(255),
    IN p_genero ENUM('M', 'F'),
    IN p_fechaNacimiento DATE,
    IN p_foto VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipoUsuario ENUM('Instructor', 'Estudiante', 'Administrador')
)
BEGIN
    INSERT INTO Usuario (NombreCompleto, Genero, FechaNacimiento, Foto, Email, Contraseña, FechaRegistro, TipoUsuario, Estado)
    VALUES (p_nombre, p_genero, p_fechaNacimiento, p_foto, p_email, p_contraseña, NOW(), p_tipoUsuario, 'Activo');
END //
DELIMITER ;
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
    IN p_contraseña VARCHAR(255)
)
BEGIN
    UPDATE Usuario
    SET NombreCompleto = p_nombre,
        Foto = p_foto,
        Email = p_email,
        Contraseña = p_contraseña,
        FechaActualizacion = NOW()
    WHERE ID = p_usuarioID;
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
DELIMITER //
CREATE PROCEDURE ReporteUsuarios (
    IN p_tipoUsuario INT
)
BEGIN
    SELECT NombreUsuario, NombreCompleto, FechaRegistro, CursosTotal, Total
    FROM Usuario, ReporteUsuario
    WHERE TipoUsuario = p_tipoUsuario AND Usuario.ID = UsuarioID;
END //
DELIMITER ;


