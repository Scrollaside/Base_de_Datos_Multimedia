
-- TRIGGER 1, Generar un diploma automáticamente al finalizar un 
DELIMITER //
CREATE TRIGGER Generar_Diploma
AFTER UPDATE ON Inscripcion
FOR EACH ROW
BEGIN
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


-- TRIGGER 2, Evita que un curso sea eliminado si tiene inscripciones activas.
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


DROP TRIGGER Generar_Diploma
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


SELECT ID, TipoUsuario FROM Usuario WHERE ID = 1;
DROP TRIGGER AdminID1;
DELIMITER //
CREATE TRIGGER AdminID1 
BEFORE INSERT ON Usuario
FOR EACH ROW
BEGIN
	IF NEW.ID = 1 THEN
		SET NEW.TipoUsuario = 3;
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER DisableUser
AFTER UPDATE ON Usuario
FOR EACH ROW
BEGIN 
	IF NEW.Intentos = 3 THEN 
		UPDATE Usuario
        SET Estado = 0
        WHERE ID = NEW.ID;
	END IF;
END //
DELIMITER ;