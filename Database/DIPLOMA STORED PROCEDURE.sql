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


UPDATE inscripcion SET Estado = 0 WHERE UsuarioID = 6;
UPDATE inscripcion SET Estado = 1 WHERE UsuarioID = 6;
SELECT * FROM Inscripcion;
SELECT * FROM Diploma;
