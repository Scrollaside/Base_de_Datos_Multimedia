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

SELECT total_ventas_curso(1); 


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

SELECT total_cursos_inscritos(1);

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
-- uso de la función
SELECT reporte_ventas_cursos('2024-01-01', '2024-11-30');-- ejemplo para mostrar las ventas totales de los cursos de lo que va de año


-- FUNCTION 4
-- FUNCTION 5
-- FUNCTION 6
-- FUNCTION 7
-- FUNCTION 8
