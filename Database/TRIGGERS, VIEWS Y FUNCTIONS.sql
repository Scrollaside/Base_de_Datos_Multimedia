DROP VIEW IF EXISTS View_MejoresCalificados;
DROP VIEW IF EXISTS View_MasVendidos;
DROP VIEW IF EXISTS View_MasRecientes;

USE BDM;

SELECT * FROM View_MejoresCalificados;
SELECT * FROM View_MasVendidos;
SELECT * FROM View_MasRecientes;

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
    DATE_FORMAT(u.FechaRegistro, '%M %D, %Y') AS Ingreso, 
    r.CursosTotal AS Cursos, 
    r.Total AS Total,
    r.Tipo AS Tipo
FROM Usuario u
JOIN ReporteUsuario r
ON u.ID = r.UsuarioID; 

-- VIEW 5, Categorias
CREATE VIEW VistaCategorias AS
SELECT ct.Nombre, ct.Descripcion, u.NombreUsuario AS Creador,  DATE_FORMAT(ct.Creacion, '%M %D %Y, %H:%i') AS Creacion -- , ct.ID
FROM Categoria ct
JOIN Usuario u ON ct.Creador = u.ID;

-- VIEW 6
CREATE VIEW VentasGeneral AS
SELECT 
    c.Titulo AS Curso, 
    COUNT(DISTINCT u.ID) AS Alumnos, 
    CONCAT('$', FORMAT(SUM(i.PrecioPagado), 2)) AS Ingresos
FROM Inscripcion i
INNER JOIN Nivel n ON n.ID = i.NivelID
INNER JOIN Curso c ON c.ID = n.CursoID
INNER JOIN Usuario u ON u.ID = i.UsuarioID
GROUP BY 
    c.ID;

SELECT * FROM VentasGeneral;
-- VIEW 7
CREATE VIEW MetodoPago AS
SELECT c.Titulo AS Curso, i.MetodoPago, CONCAT('$', FORMAT(SUM(i.PrecioPagado), 2)) AS TotalGanancias
FROM Inscripcion i
JOIN Nivel n ON i.NivelID = n.ID
JOIN Curso c ON n.CursoID = c.ID
GROUP BY c.Titulo, i.MetodoPago;
select * from usuario
SELECT * FROM MetodoPago
-- VIEW 8

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

SELECT total_ventas_curso(101); -- ID del curso


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
-- uso de la función
SELECT total_cursos_inscritos(1); -- ID del usuario


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

SELECT reporte_ventas_cursos('2024-01-01', '2024-11-30');-- ejemplo para mostrar las ventas totales de los cursos de lo que va de año


-- FUNCTION 4
-- FUNCTION 5
-- FUNCTION 6
-- FUNCTION 7
-- FUNCTION 8


-- TRIGGER 1, Generar un diploma automáticamente al finalizar un 
DELIMITER //

CREATE TRIGGER Generar_Diploma
AFTER UPDATE ON Inscripcion
FOR EACH ROW
BEGIN
    -- Declarar variables para manejar datos intermedios
    DECLARE nivel_count INT DEFAULT 0;
    DECLARE nivel_completados INT DEFAULT 0;

    -- Verificar que el estado cambió de 0 a 1
    IF NEW.Estado = 1 AND OLD.Estado = 0 THEN
        -- Obtener la cantidad de niveles del curso al que pertenece el nivel actualizado
        SELECT CantidadNiveles 
        INTO nivel_count
        FROM Curso
        WHERE ID = (SELECT CursoID FROM Nivel WHERE ID = NEW.NivelID);

        -- Contar los niveles completados por el estudiante en el curso
        SELECT COUNT(*) 
        INTO nivel_completados
        FROM Inscripcion
        WHERE UsuarioID = NEW.UsuarioID 
          AND NivelID IN (SELECT ID FROM Nivel WHERE CursoID = 
                          (SELECT CursoID FROM Nivel WHERE ID = NEW.NivelID))
          AND Estado = 1;

        -- Si los niveles completados son iguales al total de niveles, generar el diploma
        IF nivel_completados = nivel_count THEN
            INSERT INTO Diploma (EstudianteID, CursoID, FechaFin, InstructorID)
            VALUES (
                NEW.UsuarioID,  -- El ID del estudiante
                (SELECT CursoID FROM Nivel WHERE ID = NEW.NivelID), -- El curso correspondiente
                NOW(),  -- Fecha actual
                (SELECT UsuarioCreador FROM Curso WHERE ID = 
                 (SELECT CursoID FROM Nivel WHERE ID = NEW.NivelID))  -- Instructor del curso
            );
        END IF;
    END IF;
END //

DELIMITER ;

-- TRIGGER 2, Evita que un curso sea eliminado si tiene inscripciones activas.
CREATE TRIGGER bloquear_eliminacion_curso
BEFORE DELETE ON Curso
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM Inscripcion WHERE NivelID = OLD.ID AND Estado = 1) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se puede eliminar un curso con estudiantes inscritos.';
    END IF;
END;

