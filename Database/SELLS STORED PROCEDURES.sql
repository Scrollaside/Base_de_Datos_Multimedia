DELIMITER //
CREATE PROCEDURE VentasGeneralSP(
IN vg_ID INT,
IN vg_categoria VARCHAR(255),
IN vg_estado VARCHAR(255)
)
BEGIN 
IF vg_categoria = 'Todas' THEN
SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral WHERE Instructor = vg_ID AND Estado = vg_estado;
ELSEIF vg_estado = 'Todos' THEN
SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral WHERE Instructor = vg_ID AND Categoria = vg_categoria;
ELSEIF vg_categoria = 'Todas' AND vg_estado = 'Todos' THEN
SELECT Curso AS AAAAAAAAAAA, Alumnos, Promedio, Ingresos FROM VentasGeneral WHERE Instructor = vg_ID;
ELSE 
SELECT Curso, Alumnos, Promedio, Ingresos FROM VentasGeneral WHERE Instructor = vg_ID AND Estado = vg_estado AND Categoria = vg_categoria;
END IF;
END //
DELIMITER ;

CALL VentasGeneralSP(3, 'Todas', 'Todos');

DELIMITER //
CREATE PROCEDURE GananciasTotales(
IN gt_ID INT
)
BEGIN
SELECT i.MetodoPago, CONCAT('$', FORMAT(SUM(n.Costo), 2)) AS TotalGanancias, c.UsuarioCreador
FROM Inscripcion i 
JOIN Nivel n ON i.NivelID = n.ID
JOIN Curso c ON n.CursoID = c.ID
WHERE c.UsuarioCreador = gt_ID
GROUP BY i.MetodoPago;
END //
DELIMITER ;

CALL GananciasTotales(5);

DELIMITER //
CREATE PROCEDURE MetodoPagoPorCurso (
IN mp_Name VARCHAR(255),
IN mp_ID INT
)
BEGIN 
SELECT * FROM MetodoPago WHERE Curso = mp_Name AND Instructor = mp_ID;
END //
DELIMITER ;

CALL MetodoPagoPorCurso('Programacion en PHP', 5);
