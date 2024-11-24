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